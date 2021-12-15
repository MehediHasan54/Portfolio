document.addEventListener('DOMContentLoaded', function() {
    console.log('loaded');
    var Links = document.querySelectorAll(".delete");
    for (i = 0; i < Links.length; i++) {
        Links[i].addEventListener('click', function(e) {
            if (!confirm("Are you sure?")) {
                e.preventDefault();
            }
        });
    }
});