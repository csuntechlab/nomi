<template>
<div>



		<div  class="grid-container">
			<!--for loop through array objects-->
		<div class="panel" v-for="farmAnimal in farmAnimals">
			<div class="grid-item panel-content">
				<div class="panel-heading">{{ farmAnimal.animal }}</div>
					<!--Needs to be made into a separate component-->
					<label :for="farmAnimal.animal">
							<!--on upload call "changePhoto" method, ":id" is shorthand for v-bind, reference documentation-->
								<input class="hide" :id="farmAnimal.animal" @change="changePhoto" type="file" name="photo" accept="image/*">
						<div class="crop">
								<img :id="farmAnimal.animal+'-img'" :src="farmAnimal.image" class="img--circle crop img" name="photo" accept="image/*">
						</div>
					</label>
			</div>
		</div>


    	
    </div>

 

</div>
</template> 

<script>
import axios from 'axios';
export default {
    data: function () {
        return {
//            JSON object placeholder
            farmAnimals: [
                {animal: "pig", image: ''},
                {
                    animal: "chicken",
                    image: "http://www.newstalk.com/content/000/images/000129/133205_54_news_hub_123495_656x500.jpg"
                },
                {
                    animal: "rooster",
                    image: "https://bloximages.newyork1.vip.townnews.com/roanoke.com/content/tncms/assets/v3/editorial/0/1f/01fb8392-9599-54ef-a072-eccba5ef5a9b/588964584fea3.image.jpg?resize=1200%2C771"
                },
                {animal: "cow", image: "https://cdn.modernfarmer.com/wp-content/uploads/2015/08/cowburp.jpeg"},
                {
                    animal: "duck",
                    image: "https://web.stanford.edu/dept/CTL/cgi-bin/academicskillscoaching/wp-content/uploads/2012/07/baby-duck.jpg"
                },
            ],

            errors: []
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
    }
}

</script>
