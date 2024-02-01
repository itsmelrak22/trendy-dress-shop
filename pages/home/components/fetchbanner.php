<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Carousel</title>
    <link href="styles.css" rel="stylesheet">
</head>
<style>
    / Custom CSS for the carousel /
#carouselId .carousel-item img {
    max-width: 100%; / Ensure image doesn't exceed its container's width /
    height: auto; / Allow height to adjust proportionally /
    margin: 0 auto; / Center the image horizontally /
}

/ Media queries for responsive design /
@media (max-width: 576px) {
    #carouselId .carousel-item img {
        max-height: 50vh; / Adjust max height for smaller screens /
    }
}

@media (min-width: 577px) and (max-width: 768px) {
    #carouselId .carousel-item img {
        max-height: 60vh; / Adjust max height for medium screens /
    }
}

@media (min-width: 769px) and (max-width: 992px) {
    #carouselId .carousel-item img {
        max-height: 70vh; / Adjust max height for large screens /
    }
}

/ Additional media queries for even larger screens if needed /
@media (min-width: 993px) {
    #carouselId .carousel-item img {
        max-height: 80vh; / Adjust max height for extra-large screens /
    }
}

</style>
<body>

<div id="carouselId" class="carousel slide" data-bs-ride="carousel" style="max-height: 730px !important;">
    <ol class="carousel-indicators">
        <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active" aria-current="true" aria-label="First slide"></li>
        <li data-bs-target="#carouselId" data-bs-slide-to="1" aria-label="Second slide"></li>
        <li data-bs-target="#carouselId" data-bs-slide-to="2" aria-label="Third slide"></li>
    </ol>
    <div class="carousel-inner" role="listbox" style="max-height: 730px !important;">
        <div class="carousel-item active">
            <img loading="lazy" src="assets/images/1.png" class="d-block mx-auto img-fluid" alt="First slide">
        </div>
        <div class="carousel-item">
            <img loading="lazy" src="assets/images/2.jpg" class="w-100 d-block mx-auto img-fluid" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img loading="lazy" src="assets/images/3.jpg" class="w-100 d-block mx-auto img-fluid" alt="Third slide">
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

</body>
</html>
