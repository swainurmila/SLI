  <footer class="footer">
      <div class="container-fluid">
          <div class="row">
              <div class="col-sm-6">
                <script>document.write(new Date().getFullYear())</script> © Developed by Oasys Tech Solutions & Maintained by OCAC.
              </div>
          </div>
      </div>
  </footer>
  </div>
  <!-- end main content-->

  </div>
  <!-- END layout-wrapper -->

  <!-- JAVASCRIPT -->

  <script src="{{ asset('eoffice/assets/libs/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('eoffice/assets/libs/jquery/jquery.validate.min.js') }}"></script>

  <script src="{{ asset('eoffice/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('eoffice/assets/libs/metismenu/metisMenu.min.js') }}"></script>
  <script src="{{ asset('eoffice/assets/libs/simplebar/simplebar.min.js') }}"></script>
  <script src="{{ asset('eoffice/assets/libs/node-waves/waves.min.js') }}"></script>
  <script src="{{ asset('eoffice/assets/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
  <script src="{{ asset('eoffice/assets/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>

  <script src="{{ asset('eoffice/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('eoffice/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

  <!-- Datatable init js -->
  <script src="{{ asset('eoffice/assets/js/pages/datatables.init.js') }}"></script>
  <!-- apexcharts -->
  <script src="{{ asset('eoffice/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

  <!-- apexcharts init -->
  <script src="{{ asset('eoffice/assets/js/pages/apexcharts.init.js') }}"></script>
  <script src="{{ asset('eoffice/assets/js/pages/dashboard.init.js') }}"></script>

  <!-- App js -->
  <script src="{{ asset('eoffice/assets/js/app.js') }}"></script>

  {{-- data table  --}}


  <!-- Buttons examples -->
  <script src="{{ asset('eoffice/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('eoffice/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('eoffice/assets/libs/jszip/jszip.min.js') }}"></script>
  <script src="{{ asset('eoffice/assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
  <script src="{{ asset('eoffice/assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
  <script src="{{ asset('eoffice/assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('eoffice/assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('eoffice/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

  <!-- Responsive examples -->
  <script src="{{ asset('eoffice/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('eoffice/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}">
  </script>
  <script src="{{ asset('eoffice/assets/js/pages/modal.init.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Datatable init js -->

  <script>
      $('form').submit(function() {
          $('#preloader').show();
      });

      window.onload = function() {
          $('#preloader').hide();
      };

      $('.name-validation').keypress(function(event) {
          var charCode = event.which || event.keyCode;
          var inputValue = $(this).val() + String.fromCharCode(charCode);
          var regex = /^[a-zA-Z ]+$/; // it will take alphabets and spaces

          // Test the input against the regular expression
          if (!regex.test(inputValue)) {
              // Prevent the character from being added to the input
              event.preventDefault();
          }
      });

      $('.username-validation').keypress(function(event) {
          var charCode = event.which || event.keyCode;
          var inputValue = $(this).val() + String.fromCharCode(charCode);
          var regex = /^[a-zA-Z][a-zA-Z0-9]*$/; // it will take alphabets followed by optional numbers

          // Test the input against the regular expression
          if (!regex.test(inputValue)) {
              // Prevent the character from being added to the input
              event.preventDefault();
          }
      });


      $('.contract-number-validation').keypress(function(event) {
          var charCode = event.which || event.keyCode;
          var inputValue = $(this).val() + String.fromCharCode(charCode);
          var regex = /^[6-9][0-9]{0,9}$/; // Starts with 6, 7, 8, or 9 followed by up to 9 digits

          // Test the input against the regular expression
          if (!regex.test(inputValue)) {
              // Prevent the character from being added to the input
              event.preventDefault();
          }
      });

      $('.password-validation').blur(function() {
          var password = $(this).val()
          // var password = $('#password').val();

          $(".error-span").remove();

          // Clear previous validation messages
          $("span").remove();
          var $field = $(this)



          var capitalRegex = /[A-Z]/;
          var smallRegex = /[a-z]/;
          var specialRegex = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;

          if (password.length < 8) {
              $field.addClass('error-text');
              $field.removeClass('success-text');
              $field.after(
                  '<span style="color:red">Password must be at least 8 characters long & one capital letter & one lowercase letter & one special character</span>'
              );
              // alert("Password must be at least 8 characters long");
              $(this).val('');
              return;
          }

          if (!capitalRegex.test(password)) {

              $field.addClass('error-text');
              $field.removeClass('success-text');
              $field.after(
                  '<span style="color:red">Password must be at least 8 characters long & one capital letter & one lowercase letter & one special character</span>'
              );
              $(this).val('');
              return;
          }

          if (!smallRegex.test(password)) {

              $field.addClass('error-text');
              $field.removeClass('success-text');
              $field.after(
                  '<span style="color:red">Password must be at least 8 characters long & one capital letter & one lowercase letter & one special character</span>'
              );
              $(this).val('');
              return;
          }

          if (!specialRegex.test(password)) {

              $field.addClass('error-text');
              $field.removeClass('success-text');
              $field.after(
                  '<span style="color:red">Password must be at least 8 characters long & one capital letter & one lowercase letter & one special character</span>'
              );
              $(this).val('');
              return;
          }

      });

      $('.number-name-validation').keypress(function(event) {
          var charCode = event.which || event.keyCode;
          var inputValue = $(this).val() + String.fromCharCode(charCode);
          var regex = /^[a-zA-Z0-9][a-zA-Z0-9\s]*$/; // only letters, numbers, and spaces, no special characters

          // Test the input against the regular expression
          if (!regex.test(inputValue)) {
              // Prevent the character from being added to the input
              event.preventDefault();
          }
      });
      $(document).ready(function() {
        // Remove the href attribute
        $("a.no_link").removeAttr("href");

        // Add a click event listener
        $("a.no_link").on("click", function(event) {
            event.preventDefault(); // Prevent the default action
            var url = $(this).data("href");
            window.location.href = url; // Navigate to the URL
        });
    });

      // $('.price-validation').keypress(function(event) {
      //       var charCode = event.which || event.keyCode;
      //     var inputValue = $(this).val() + String.fromCharCode(charCode);
      //      var regex = /^-?\d*\.?\d+$/;
      //     // /^[a-zA-Z0-9][a-zA-Z0-9\s]*$/; // only letters, numbers, and spaces, no special characters

      //     // Test the input against the regular expression
      //     if (!regex.test(inputValue)) {
      //         // Prevent the character from being added to the input
      //         event.preventDefault();
      //     }
      // });
  </script>



  @yield('script')
