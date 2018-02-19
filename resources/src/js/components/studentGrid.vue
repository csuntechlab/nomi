<template>
    <div v-if="show">
        <shuffle-button></shuffle-button>
        <!--for loop through array objects-->
		<div class="col-xs-6" v-for="student in this.students">
            <div class="panel">
                <div class="grid-item panel-content">
                    <!--Needs to be made into a separate component-->
                    <label :for="student.display_name">
                        <!--on upload call "changePhoto" method, ":id" is shorthand for v-bind, reference documentation-->
                        <input class="hide" :id="student.display_name" @change="changePhoto($event, student.email);" type="file" name="photo" accept="image/*">
                        <!--<img :id="student.display_name+'-img'" :src="student.image" class="img&#45;&#45;circle grid-image" name="photo" accept="image/*">-->
                        <profile-image :id="student.display_name+'-img'" :studentImage=student.image></profile-image>
                    </label>
                    <div class="card-title">
                        <div class="panel-heading">
                            {{student.display_name}}
                        </div>
                    </div>
                    <div v-if="student.recognized">
                        <button role="button" class="btn btn-default" @click="updateRecognized(student.recognized, student.student_id)">Mark as unrecognized</button>
                    </div>
                    <div v-else>
                        <button role="button" class="btn btn-default" @click="updateRecognized(student.recognized, student.student_id)">Mark as recognized</button>
                    </div>
                </div>
            </div>
		</div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "student-grid",

    created () {
        /** Create event listeners */
        this.$eventBus.$on('shuffleCards', function () {
            this.shuffleCardsHandler();
        }.bind(this));

        this.$eventBus.$on('toggleView', function () {
            this.toggleViewHandler();
        }.bind(this));

    },

    mounted () {
        /** Transform prop into attribute */
        this.students = JSON.parse(this.studentsjson);
    },

    data: function () {
        return {
            students: [],
            show: true,
            messages: true,
            errors: [],
        }
    },

    props: ['studentsjson'],

    methods: {
		changePhoto: function(event, email) {
//		    grabs id of image
            let imageId = document.getElementById(event.target.id + "-img");
//            checks if empty and sets file instance to variable files
            let files = event.target.files;
            if (!files[0]) {
                return;
            }

            let data = new FormData();
            data.append('media', files[0]);
            data.append('email', email);
            let reader = new FileReader();
//            On load of file, grab the image id's src that contains image
//				and equal it to the add image file
            reader.onload = (event) => {
                imageId.src = event.target.result;
            };

//            this check is needed to prevent "blob error"
            if(files[0]){
                reader.readAsDataURL(files[0]);
            }

            this.axios.post('http://nameface.test/api/upload', data, {
                headers: {
                	'Content-Type': 'multipart/form-data'
				}
			})
                .then(response => {
                    console.log(response);
				})
                .catch(e => {
                    this.errors.push(e)
                });
		},

		updateRecognized: function(recognized, id) {
            let data = new FormData();
            data.append('student_id', id);

            if(recognized) {
                this.axios.post('http://nameface.test/markAsUnrecognized', data)
                    .then(response => {
                        console.log(response);

                        this.students.find(
                            function (e){
                                return e.student_id === id;
                            }).recognized = false;
                        })
                    .catch(e => {
                        this.errors.push(e)
                        });
            } else {
                this.axios.post('http://nameface.test/markAsRecognized', data)
                    .then(response => {
                        console.log(response);

                        this.students.find(
                            function (e){
                                return e.student_id === id;
                            }).recognized = true;
                        })
                    .catch(e => {
                        this.errors.push(e)
                        });
            }

            //Hacky refresh
            this.show = false;
            this.show = true;
        },

        shuffleCardsHandler: function () {
            let currentIndex = this.students.length, temporaryValue, randomIndex;

            // While there remain elements to shuffle...
            while (0 !== currentIndex) {

                // Pick a remaining element...
                randomIndex = Math.floor(Math.random() * currentIndex);
                currentIndex -= 1;

                // And swap it with the current element.
                temporaryValue = this.students[currentIndex];
                this.students[currentIndex] = this.students[randomIndex];
                this.students[randomIndex] = temporaryValue;
            }

            //Hacky refresh
            this.show = false;
            this.show = true;
		},

        toggleViewHandler: function () {
            this.show = !this.show;
        }
    },

}

</script>
