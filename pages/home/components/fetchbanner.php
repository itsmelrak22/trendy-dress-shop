<style>
    /* Add custom CSS to set the height and center the carousel images */
    #carouselId .carousel-item img {
        object-fit: contain;
        max-height: 400px;
        width: 100%;
        margin: 0 auto; /* To center the image horizontally */
    }
</style>
<div id="carouselId" class="carousel slide" data-bs-ride="carousel" style="max-height: 400px; overflow: hidden;">
    <ol class="carousel-indicators">
        <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active" aria-current="true" aria-label="First slide"></li>
        <li data-bs-target="#carouselId" data-bs-slide-to="1" aria-label="Second slide"></li>
        <li data-bs-target="#carouselId" data-bs-slide-to="2" aria-label="Third slide"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
            <img src="assets/images/Logo.jpeg" class="d-block mx-auto" alt="First slide" style="width: 100%;">
            <div class="carousel-caption d-none d-md-block">
                <!-- <h3>Image Title 1</h3>
                <p>Description</p> -->
            </div>
        </div>
        <div class="carousel-item">
            <img src="assets/images/11.jpg" class="w-100 d-block mx-auto" alt="Second slide" style="width: 100%; ">
            <div class="carousel-caption d-none d-md-block">
                <!-- <h3>Image Title 2</h3>
                <p>Description</p> -->
            </div>
        </div>
        <div class="carousel-item">
            <img src="assets/images/22.jpg" class="w-100 d-block mx-auto" alt="Third slide" style="width: 100%;">
            <div class="carousel-caption d-none d-md-block">
                <!-- <h3>Image Title 3</h3>
                <p>Description</p> -->
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>