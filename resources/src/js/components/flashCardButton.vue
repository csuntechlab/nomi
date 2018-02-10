<template>
    <div>
        <button @click="flashCard" id="myDiv" role="button" class="btn btn-default">Button</button>
    </div>
</template>

<script>
export default {
    methods: {
        flashCard: function () {
            // grabs id of image
            var imageId = document.getElementById("myDiv");
            // var textId = document.getElementById("textA");
            if (imageId.style.display !== "none") {
                imageId.style.display = "none";
                // textId.style.display = "block";
            } else {
                imageId.style.display = "block";
                // textId.style.display = "none";
            }
        }
    }
}
</script>>