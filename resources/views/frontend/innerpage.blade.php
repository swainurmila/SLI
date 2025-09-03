@extends('frontend.layouts.app')
@section('content')

    @if ($page == null)
        <div class="theme-inner-banner mb-3">
            <div class="overlay">
                <div class="container">
                    <h2>NOT FOUND !</h2>
                </div> <!-- /.container -->
            </div> <!-- /.overlay -->
        </div>
    @else
        @if ($page->pageTemplate == null)
            <div class="theme-inner-banner mb-3">
                <div class="overlay">
                    <div class="container">
                        <h2>{!! $page->getTranslation('post_title', $lang) !!}</h2>
                    </div> <!-- /.container -->
                </div> <!-- /.overlay -->
            </div>
        @endif

        @if ($page->pageTemplate && $page->pageTemplate->temp_slug !== 'mission_vision')
            <div class="theme-inner-banner mb-3">
                <div class="overlay">
                    <div class="container">
                        <h2>{!! $page->getTranslation('post_title', $lang) !!}</h2>
                    </div> <!-- /.container -->
                </div> <!-- /.overlay -->
            </div>
        @endif




        @php

            if ($page->pageTemplate == '') {
                $fileName = 'default.blade.php';
            } else {
                $fileName = $page->pageTemplate->temp_slug . '.blade.php';
            }

            $filePath = resource_path('views/admin/templates/' . $fileName);

            $include_path = 'admin.templates.';
        @endphp


        @if (file_exists($filePath))
            @if ($page->pageTemplate == '')
                @include($include_path . 'default')
            @else
                @include($include_path . $page->pageTemplate->temp_slug)
            @endif
        @else
            <h1>No File Found</h1>
        @endif
    @endif
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            var img = "{{ $page->post_attachment ?? '' }}";
            if (img) {
                $('.theme-inner-banner').css("background-image", "url('" + img + "')");
            }


            var columns = [];
            if ($('#ztable tbody tr:first-child th').length > 0) {
                $('#ztable tbody tr:first-child th').each(function() {
                    columns.push($(this).text());
                });
            } else {
                $('#ztable tbody tr:first-child td').each(function() {
                    columns.push($(this).text());
                });
            }
            var headingRow = $('#ztable tbody tr:first-child').detach();
            $('#ztable thead').append(headingRow);

            //$('#ztable tbody tr:first-child').remove();
            $('#ztable').DataTable({
                "order": [
                    [0, 'desc']
                ],
                "columnDefs": [{
                        "orderable": true,
                        "targets": 0
                    },
                    {
                        "className": "dt-center",
                        "targets": "_all"
                    }
                ],
                "columns": columns.map(function(col) {
                    return {
                        "title": col
                    };
                })
            });
            $('#ztable thead').addClass('thead-light');
            $('#ztable').addClass('table table-bordered');

            var $affectedElements = $("p, span, a, h3, h4, div, i");
            $affectedElements.each(function() {
                var $this = $(this);
                $this.data("orig-size", $this.css("font-size"));
            });

            $("#btn-increase").click(function() {
                changeFontSize(1);
            });

            $("#btn-decrease").click(function() {
                changeFontSize(-1);
            });

            $("#btn-orig").click(function() {
                $affectedElements.each(function() {
                    var $this = $(this);
                    $this.css("font-size", $this.data("orig-size"));
                });
            });

            function changeFontSize(direction) {
                $affectedElements.each(function() {
                    var $this = $(this);
                    $this.css("font-size", parseInt($this.css("font-size")) + direction);
                });
            }
        });





        // Gallery image hover
        $(".img-wrapper").hover(
            function() {
                $(this).find(".img-overlay").animate({
                    opacity: 1
                }, 600);
            },
            function() {
                $(this).find(".img-overlay").animate({
                    opacity: 0
                }, 600);
            }
        );

        // Lightbox
        var $overlay = $('<div id="overlay"></div>');
        var $contentContainer = $('<div class="content"></div>');
        // var $video = $("<video>");
        var $prevButton = $('<div id="prevButton"><i class="fa fa-chevron-left"></i></div>');
        var $nextButton = $('<div id="nextButton"><i class="fa fa-chevron-right"></i></div>');
        var $exitButton = $('<div id="exitButton"><i class="fa fa-times"></i></div>');

        // Add overlay
        $overlay.append($contentContainer).prepend($prevButton).append($nextButton).append($exitButton);
        $("#gallery").append($overlay);

        // Hide overlay on default
        $overlay.hide();

        // $(".img-overlay").click(function(event) {
        //     event.preventDefault();
        //     var imageLocation = $(this).prev().attr("href");
        //     $image.attr("src", imageLocation);
        //     $overlay.fadeIn("slow");
        // });



        $(".img-overlay").click(function(event) {
            event.preventDefault();
            var mediaLocation = $(this).prev('a').attr('href');

            console.log(mediaLocation)
            var mediaType = mediaLocation.split('.').pop().toLowerCase();

            // Clear previous content
            $contentContainer.empty();

            var $media;
            if (mediaType === 'mp4') {
                $media = $('<video controls autoplay width="100%" height="auto">')
                    .append($('<source>', {
                        src: mediaLocation,
                        type: 'video/mp4'
                    }));
            } else {
                $media = $('<img>', {
                    src: mediaLocation,
                    alt: 'Gallery Image',
                    width: '100%',
                    height: 'auto'
                });
            }

            // Append the media to the content area and fade in the overlay
            $contentContainer.append($media);
            $overlay.fadeIn('slow');
        });

        // When the overlay is clicked
        $overlay.click(function() {
            // Fade out the overlay
            $(this).fadeOut("slow");
        });




        function updateMedia(mediaLocation) {
            var $content = $("#overlay .content");
            $content.empty(); // Clear the current content

            var mediaType = mediaLocation.split('.').pop(); // Extract the file extension

            if (mediaType === 'mp4') {
                var $media = $('<video controls>', {
                    'src': mediaLocation,
                    'width': '100%',
                    'height': 'auto'
                });
                $media.append($('<source>', {
                    'src': mediaLocation,
                    'type': 'video/mp4'
                }));
                $content.append($media);
                $media.get(0).play(); // Auto-play for video
            } else {
                var $media = $('<img>', {
                    'src': mediaLocation,
                    'alt': 'Gallery Image',
                    'width': '100%',
                    'height': 'auto'
                });
                $content.append($media);
            }
            $content.fadeIn(800);
        }

        // When next button is clicked
        $nextButton.click(function(event) {
            event.preventDefault();

            var $currentContent = $("#overlay .content").children(":first");
            var currentMediaSrc = $currentContent.attr('src');

            // Image with matching location of the current media in the overlay
            var $currentGalleryItem = $('#image-gallery [src="' + currentMediaSrc + '"]').closest('.image');
            var $nextGalleryItem = $currentGalleryItem.next().find('img, video');

            if ($nextGalleryItem.length === 0) {
                // Wrap to the first item if there's no next item
                $nextGalleryItem = $('#image-gallery img, #image-gallery video').first();
            }

            updateMedia($nextGalleryItem.attr('src'));
            event.stopPropagation();
            // // Hide the current image
            // $("#overlay img").hide();
            // // Overlay image location
            // var $currentImgSrc = $("#overlay img").attr("src");

            // // Image with matching location of the overlay image
            // var $currentImg = $('#image-gallery img[src="' + $currentImgSrc + '"]');
            // // Finds the next image
            // var $nextImg = $($currentImg.closest(".image").next().find("img"));
            // // All of the images in the gallery
            // var $images = $("#image-gallery img");
            // // If there is a next image
            // if ($nextImg.length > 0) {
            //     // Fade in the next image
            //     $("#overlay img").attr("src", $nextImg.attr("src")).fadeIn(800);
            // } else {
            //     // Otherwise fade in the first image
            //     $("#overlay img").attr("src", $($images[0]).attr("src")).fadeIn(800);
            // }
            // // Prevents overlay from being hidden
            // event.stopPropagation();
        });

        // When previous button is clicked
        $prevButton.click(function(event) {
            // // Hide the current image
            // $("#overlay img").hide();
            // // Overlay image location
            // var $currentImgSrc = $("#overlay img").attr("src");
            // // Image with matching location of the overlay image
            // var $currentImg = $('#image-gallery img[src="' + $currentImgSrc + '"]');
            // // Finds the next image
            // var $nextImg = $($currentImg.closest(".image").prev().find("img"));
            // // Fade in the next image
            // $("#overlay img").attr("src", $nextImg.attr("src")).fadeIn(800);
            // // Prevents overlay from being hidden
            // event.stopPropagation();

            event.preventDefault();

            var $currentContent = $("#overlay .content").children(":first");
            var currentMediaSrc = $currentContent.attr('src');

            var $currentGalleryItem = $('#image-gallery [src="' + currentMediaSrc + '"]').closest('.image');
            var $prevGalleryItem = $currentGalleryItem.prev().find('img, video');

            if ($prevGalleryItem.length === 0) {
                // Wrap to the last item if there's no previous item
                $prevGalleryItem = $('#image-gallery img, #image-gallery video').last();
            }

            updateMedia($prevGalleryItem.attr('src'));
            event.stopPropagation();
        });

        // When the exit button is clicked
        $exitButton.click(function() {
            // Fade out the overlay
            $("#overlay").fadeOut("slow");
        });
    </script>
@endsection
