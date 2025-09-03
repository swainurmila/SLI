
     
      
<div class="service-details section-spacing">
    <div class="container">
        
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-bordered" id="ztable">
                        {{-- <thead class="thead-light"> --}}
                        <tbody>
                          <tr>
                            <th scope="col">Sl No.</th>
                            <th scope="col">Subject Name</th>
                            <th scope="col">Action</th>
                          </tr>
                        {{-- </thead> --}}
                        
                         
                            {{-- <th scope="row">1</th>
                            <td>Invitation of EoI for Research & Case Studies on Labour related subjects under SLI, Odisha </td>
                            <td><button class="btn btn-sm theme-button-one"><span><i class="fa fa-download mr-2"></i></span>Download</button></td> --}}
                            @foreach ($tender as $key=>$item)
                            <tr>
                                <th scope="row">{{++$key}}</th>
                                <td>{{ Tender($item->id, 'title', $lang) }}</td>
                                <td><a href="{{ asset($item->attachment_file) }}" download title="KALIA (Krushak Assistance for Livelihood &amp; Income Augmentation" class="btn btn-sm theme-button-one">
                                    <span class="pulse2"><i class="fa fa-download mr-2"></i>Download</span></a></td>
                                </tr>
                            @endforeach
                        

                          {{-- @foreach ($tender as $item)
                          <li>
          
                            <a href="{{ asset($item->attachment_file) }}" download title="KALIA (Krushak Assistance for Livelihood &amp; Income Augmentation">{{ Tender($item->id, 'title', $lang) }}
                                <span class="pulse2">New</span>
                            </a>
                          </li>
                      @endforeach --}}

                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>



