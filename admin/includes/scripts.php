    <script src="js/jquery-3.6.0.min.js"></script>  <!-- pentru editare car descriere, sa putem pune design -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="js/jquery.dataTables.min.js"></script>  <!-- pentru tabele -->
    <script src="js/dataTables.bootstrap5.min.js"></script>  <!-- pentru tabele -->
    
    <script>
        $(document).ready( function () {
            $('#myDataTable').DataTable();
        } );
    </script>
   
    <script src="js/scripts.js"></script>

    

    <!-- Summernote JS - CDN Link  pentru descrierea la masina sa putem edita textul-->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function() {
            // $("#summernote").summernote();
            $('#summernote').summernote({
        placeholder: 'Adauga descrierea aici.',
        height: 100
      });
            $('.dropdown-toggle').dropdown();
        });
    </script>
    <!-- //Summernote JS - CDN Link -->

</body>
</html>
