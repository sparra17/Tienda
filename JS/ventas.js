
function navbar() {
        var currentLocation = window.location.href;
        var links = document.querySelectorAll("ul li a");
    
        links.forEach(function(link) {
            link.addEventListener("click", function() {
                links.forEach(function(item) {
                    item.classList.remove("active");
                });
            this.classList.add("active");
        });
            if (currentLocation.indexOf(link.getAttribute("href")) !== -1) {
                link.classList.add("active");
            }
        });
    }
