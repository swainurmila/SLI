<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <script>
                    document.write(new Date().getFullYear())
                </script> © e-Library Developed by Oasys Tech Solutions & Maintained by OCAC.
            </div>
        </div>
    </div>
</footer>
</div>
<!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!-- JAVASCRIPT -->

<script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('user-assets/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('assets/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('assets/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>

<script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

<!-- Datatable init js -->
<script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
<!-- apexcharts -->
<script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- apexcharts init -->
<script src="{{ asset('assets/js/pages/apexcharts.init.js') }}"></script>
<script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>

<!-- App js -->
<script src="{{ asset('assets/js/app.js') }}"></script>

{{-- data table  --}}


<!-- Buttons examples -->
<script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

<!-- Responsive examples -->
<script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/modal.init.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

{{--
<script>
    // Function to handle the contextmenu event (right-click)
    function handleContextMenu(event) {
      event.preventDefault(); // Prevent the default context menu from appearing
    }

    // Function to handle the keydown event (Ctrl+U)
    function handleKeyDown(event) {
      if (event.ctrlKey && event.key === 'u') {
        event.preventDefault(); // Prevent the default behavior of Ctrl+U
      }
    }

    // Attach the contextmenu event listener to the document
    document.addEventListener('contextmenu', handleContextMenu);

    // Attach the keydown event listener to the document
    document.addEventListener('keydown', handleKeyDown);
  </script> --}}

<!-- Datatable init js -->

<script>
    $('.name-validation').keypress(function(event) {
        var charCode = event.which || event.keyCode;
        var inputValue = $(this).val() + String.fromCharCode(charCode);
        var regex = /^[a-zA-Z][a-zA-Z ]*$/; // it will take alphabets and spaces

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
    function validateKeyPress(event) {
            // Prevent spaces at the beginning of the input
            if (event.key === ' ' && event.target.value.length === 0) {
                return false;
            }

            // Allow only letters and spaces
            const regex = /^[a-zA-Z\s]*$/;
            return regex.test(event.key);
        }

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
