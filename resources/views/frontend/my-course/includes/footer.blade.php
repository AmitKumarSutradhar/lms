<!-- template js files -->
<script src="{{ asset('/') }}frontend/js/jquery-3.4.1.min.js"></script>
<script src="{{ asset('/') }}frontend/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('/') }}frontend/js/bootstrap-select.min.js"></script>
<script src="{{ asset('/') }}frontend/js/owl.carousel.min.js"></script>
<script src="{{ asset('/') }}frontend/js/isotope.js"></script>
<script src="{{ asset('/') }}frontend/js/waypoint.min.js"></script>
<script src="{{ asset('/') }}frontend/js/jquery.counterup.min.js"></script>
<script src="{{ asset('/') }}frontend/js/fancybox.js"></script>
<script src="{{ asset('/') }}frontend/js/plyr.js"></script>
<script src="{{ asset('/') }}frontend/js/datedropper.min.js"></script>
<script src="{{ asset('/') }}frontend/js/emojionearea.min.js"></script>
<script src="{{ asset('/') }}frontend/js/jquery-te-1.4.0.min.js"></script>
<script src="{{ asset('/') }}frontend/js/jquery.MultiFile.min.js"></script>
<script src="{{ asset('/') }}frontend/js/main.js"></script>
<script>
    var player = new Plyr('#player');
</script>
<script type="text/javascript">
    // Function to open the first lecture when the page loads
    function openFirstLecture() {
        const firstLecture = document.querySelector('.lecture-title'); // Get the first lecture element
        if (firstLecture) {
            firstLecture.click(); // Trigger the click event on the first lecture
        }
    }

    // Function to handle lecture clicks and load content
    function viewLesson(videoUrl, vimeoUrl, textContent) {
        const video = document.getElementById("videoContainer");
        const text = document.getElementById("textLesson");
        const textContainer = document.createElement("div");

        if (videoUrl && videoUrl.trim() !== "") {
            video.classList.remove("d-none");
            text.classList.add("d-none");
            text.innerHTML = "";
            video.setAttribute("src", videoUrl);
        } else if (vimeoUrl && vimeoUrl.trim() !== "") {
            video.classList.remove("d-none");
            text.classList.add("d-none");
            text.innerHTML = "";
            video.setAttribute("src", vimeoUrl);
        } else if (textContent && textContent.trim() !== "") {
            video.classList.add("d-none");
            text.classList.remove("d-none");
            text.innerHTML = "";
            textContainer.innerText = textContent;
            textContainer.style.fontSize = "14px";
            textContainer.style.textAlign = "left";
            textContainer.style.paddingLeft = "40px";
            textContainer.style.paddingRight = "40px";
            text.appendChild(textContainer);
        }
    }

    // Add a click event listener to all lecture elements
    document.querySelectorAll('.lecture-title').forEach((lectureTitle) => {
        lectureTitle.addEventListener('click', () => {
            const videoUrl = lectureTitle.getAttribute('data-video-url');
            const vimeoUrl = lectureTitle.getAttribute('data-vimeo-url');
            const textContent = lectureTitle.getAttribute('data-content');
            viewLesson(videoUrl, vimeoUrl, textContent);
        });
    });

    // Open the first lecture when the page loads
    window.addEventListener('load', () => {
        openFirstLecture();
    });
</script>
