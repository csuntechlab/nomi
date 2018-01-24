<template>
<div>

		<div  class="grid-container">
		<div v-for="farmAnimal in farmAnimals">
			<div class="grid-item">
				<div>{{ farmAnimal.animal }}</div>
				<!--img tag that takes the camera goes in here. -->
				<img :src="farmAnimal.image" width="100px" :alt="farmAnimal.animal">
			</div>
		</div>
    	
    </div>

 

</div>
</template> 

<script>

export default {
	data: function () {
		return {
			farmAnimals: [
				{ animal: "Pig", image: "https://kids.nationalgeographic.com/content/dam/kids/photos/animals/Mammals/H-P/pig-young-closeup.ngsversion.1412640764383.jpg" },
	    		{ animal: "Chicken", image: "http://www.newstalk.com/content/000/images/000129/133205_54_news_hub_123495_656x500.jpg" },
	    		{ animal: "Duck", image: "https://web.stanford.edu/dept/CTL/cgi-bin/academicskillscoaching/wp-content/uploads/2012/07/baby-duck.jpg" },
	    		{ animal: "Rooster", image: "https://bloximages.newyork1.vip.townnews.com/roanoke.com/content/tncms/assets/v3/editorial/0/1f/01fb8392-9599-54ef-a072-eccba5ef5a9b/588964584fea3.image.jpg?resize=1200%2C771" },
	    		{ animal: "Cow", image: "https://cdn.modernfarmer.com/wp-content/uploads/2015/08/cowburp.jpeg" }
	    		
			],
			
		}
	},

	
	// methods: {
	// 	convertToString: function(){
	// 		this.farmAnimals = JSON.stringify(this.farmAnimals);
	// 	},
	// 	convertToJSON: function(data){
	// 		this.farmAnimals = JSON.parse(this.farmAnimals);
	// 	}
	// },
	//
	//
	// created: function(){
	// 	var vm = this;
	// 	axios.get("https://hplussport.com/api/products").then(function (response) {
	// 	    vm.products = this.convertToString(response.data);
	// 	  });
	// },
    //  created: function() {
    //     $.getJSON('https://hplussport.com/api/products')
    //        .done(function(data) {
    //             vm.theProducts = data; 
    //         });
    //  }

}

</script>
