<script>
    $(document).ready(function() {

        var classname = document.querySelectorAll("#mainTab button");
        classname.forEach(element => {

            if (element.ariaSelected == 'true') {
                // SELECCIONADO
                element.style.color = "#FDC700";
                element.style.background = '#1B3D73';
            }

            element.addEventListener("click", function() {
                document.querySelectorAll("#mainTab button").forEach(e => {
                    // NO SELECCIONADO
                    e.style.color = "#1B3D73";
                    e.style.background = 'none';
                });

                // SELECCIONADO
                element.style.color = "#FDC700";
                element.style.background = '#1B3D73';

            }, false);
        });
    })
</script>
