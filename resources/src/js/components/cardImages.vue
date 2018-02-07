<template>
    <div  class="grid-container">
        <!--for loop through array objects-->
		<div class="panel" v-for="student in JSON.parse(students)">
			<div class="grid-item panel-content">
				<div class="panel-heading">{{student.display_name}}</div>
					<!--Needs to be made into a separate component-->
					<label :for="student.display_name">
							<!--on upload call "changePhoto" method, ":id" is shorthand for v-bind, reference documentation-->
								<input class="hide" :id="student.display_name" @change="changePhoto" type="file" name="photo" accept="image/*">
						<div class="crop">
								<img :id="student.display_name+'-img'" :src="student.image" class="img--circle crop img" name="photo" accept="image/*">



		<div  class="container">
			<!--for loop through array objects-->
			<!--<div class="row">-->
				<div class="type--center">

					<div class="col-xs-4 no-padding" v-for="farmAnimal in farmAnimals">
						<div class="panel">
							<div class="panel-content">
								<div class="panel-heading">{{ farmAnimal.animal }}</div>
								<!--Needs to be made into a separate component-->
								<label class="crop" :for="farmAnimal.animal">
										<!--on upload call "changePhoto" method, ":id" is shorthand for v-bind, reference documentation-->
											<input class="hide" :id="farmAnimal.animal" @change="changePhoto" type="file" name="photo" accept="image/*">
											<img :id="farmAnimal.animal+'-img'" :src="farmAnimal.image" class="img--circle img" name="photo" accept="image/*">
								</label>
						</div>
					</div>
				</div>
			<!--</div>-->
		</div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    /*created () {
            console.log(JSON.parse(this.students))
	},*/
    data: function () {
        return {
            errors: [],
        }
    },

    methods: {
		changePhoto: function(event) {
//		    grabs id of image
            let imageId = document.getElementById(event.target.id + "-img");
//            checks if empty and sets file instance to variable files
            let files = event.target.files;
            if (!files[0]) {
                return;
            }

            let data = new FormData();
            data.append('media', files[0]);
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
		}
    },

    props: ['students']
}

</script>
