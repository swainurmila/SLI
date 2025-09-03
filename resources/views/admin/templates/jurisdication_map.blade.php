<section id="about-part">
    <div class="container">
        <div class="section-title3">
            <h3>{!!  $page->getTranslation('post_title', $lang)  !!}</h3>
        </div>

        <img data-toggle="modal" data-target="#myModal" class="img-thumbnail img-responsive" src="{{ asset('uploads/jurisdiction-map-amall.jpg')}}">
    </div>
    <div class="modal fade" id="myModal" role="dialog" >
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">×</button>
              <h4 class="modal-title">CDA Jurisdication Map</h4>
            </div>
            <div class="modal-body">
              <img class=" img-responsive" src="{{ asset('uploads/jurisdication_map_new_bg.jpg') }}">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
</section>
