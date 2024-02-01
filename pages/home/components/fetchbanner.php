<style>
    /* Custom CSS for the carousel */
    #carouselId .carousel-item img {
        object-fit: contain;
        max-height: 400px;
        width: 100%;
        margin: 0 auto; /* Center the image horizontally */
    }

    /* Style for the quote and assurance message */
    .quote-wrapper {
        position: absolute;
        bottom: 20px; /* Adjust as needed */
        left: 50%;
        transform: translateX(-50%);
        /* background-color: rgba(0, 0, 0, 0.7); */
        padding: 10px 20px;
        border-radius: 10px;
        color: #ffffff;
        text-align: center;
        max-width: 80%;
    }

    .quote-wrapper h3 {
        font-size: 24px;
        margin-bottom: 5px;
    }

    .quote-wrapper p {
        font-size: 16px;
        margin: 0;
    }
</style>
<div id="carouselId" class="carousel slide" data-bs-ride="carousel" style="max-height: 400px; overflow: hidden; position: relative;">
    <ol class="carousel-indicators">
        <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active" aria-current="true" aria-label="First slide"></li>
        <li data-bs-target="#carouselId" data-bs-slide-to="1" aria-label="Second slide"></li>
        <li data-bs-target="#carouselId" data-bs-slide-to="2" aria-label="Third slide"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
            <img src="assets/images/Logo.jpeg" class="d-block mx-auto" alt="First slide" style="width: 100%;">
            <div class="carousel-caption d-none d-md-block quote-wrapper">
                <h3>IT'S NOT ABOUT BRAND, IT'S ABOUT STYLE</h3>
                <p>We can assure you of a guaranteed high quality but affordable item.</p>
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
