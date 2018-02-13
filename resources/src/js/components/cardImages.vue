<template>
    <div>
        <!--for loop through array objects-->
		<div class="col-xs-6" v-for="student in JSON.parse(students)">
            <div class="panel">
                <div class="grid-item panel-content">
                    <!--Needs to be made into a separate component-->
                    <label :for="student.display_name">
                        <!--on upload call "changePhoto" method, ":id" is shorthand for v-bind, reference documentation-->
                        <input class="hide" :id="student.display_name" @change="changePhoto($event, student.email);" type="file" name="photo" accept="image/*">
                        <img :id="student.display_name+'-img'" :src="student.image" class="img--circle grid-image" name="photo" accept="image/*">
                    </label>
                    <div class="card-title">
                        <div class="panel-heading">
                            {{student.display_name}}
                        </div>
                    </div>
                </div>
            </div>
		</div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    created () {
        /** Creates listener for shuffleCards event, applying method on event. */
        this.$eventBus.$on('shuffleCards', function () {
            this.shuffleCardsHandler();
        }.bind(this));
    },

    data: function () {
        return {
            errors: [],
        }
    },

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

        shuffleCardsHandler: function () {
            let array = JSON.parse(this.students);
            let currentIndex = array.length, temporaryValue, randomIndex;

            // While there remain elements to shuffle...
            while (0 !== currentIndex) {

                // Pick a remaining element...
                randomIndex = Math.floor(Math.random() * currentIndex);
                currentIndex -= 1;

                // And swap it with the current element.
                temporaryValue = array[currentIndex];
                array[currentIndex] = array[randomIndex];
                array[randomIndex] = temporaryValue;
            }

            this.students = JSON.stringify(array);
		}
    },

    props: ['students']
}

</script>
