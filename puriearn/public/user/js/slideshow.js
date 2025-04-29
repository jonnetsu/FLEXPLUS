window.addEventListener('load', function() {
    // Fetch images from PHP database
    fetch('fetch-images.php')
      .then(response => response.json())
      .then(data => {
        const slideshow = document.getElementById('slideshow');
        const dotsContainer = document.querySelector('.dots');
  
        data.forEach((imageUrl, index) => {
          const slide = document.createElement('div');
          slide.classList.add('slide');
          if (index === 0) {
            slide.classList.add('active');
          }
          slide.style.backgroundImage = `url('${imageUrl}')`;
          slideshow.appendChild(slide);
  
          const dot = document.createElement('span');
          dot.classList.add('dot');
          if (index === 0) {
            dot.classList.add('active');
          }
          dot.addEventListener('click', function() {
            showSlide(index);
          });
          dotsContainer.appendChild(dot);
        });
  
        // Auto start slideshow
        let slideIndex = 0;
        showSlide(slideIndex);
  
        function showSlide(index) {
          const slides = document.getElementsByClassName('slide');
          const dots = document.getElementsByClassName('dot');
  
          for (let i = 0; i < slides.length; i++) {
            slides[i].classList.remove('active');
            dots[i].classList.remove('active');
          }
  
          slides[index].classList.add('active');
          dots[index].classList.add('active');
          slideIndex = index;
        }
  
        // Swipe gestures
        let touchStartX = 0;
        let touchEndX = 0;
        const minSwipeDistance = 100;
  
        slideshow.addEventListener('touchstart', function(event) {
          touchStartX = event.touches[0].clientX;
        });
  
        slideshow.addEventListener('touchend', function(event) {
          touchEndX = event.changedTouches[0].clientX;
          handleSwipeGesture();
        });
  
        function handleSwipeGesture() {
          const distanceX = touchEndX - touchStartX;
          if (distanceX > minSwipeDistance && slideIndex > 0) {
            showSlide(slideIndex - 1); // Show previous slide
          } else if (distanceX < -minSwipeDistance && slideIndex < data.length - 1) {
            showSlide(slideIndex + 1); // Show next slide
          }
        }
  
        // Auto slide
        setInterval(function() {
          if (slideIndex < data.length - 1) {
            showSlide(slideIndex + 1); // Show next slide
          } else {
            showSlide(0); // Show first slide
          }
        }, 5000); // Change slide every 5 seconds
      });
  });
  