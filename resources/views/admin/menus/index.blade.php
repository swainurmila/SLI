@extends('admin.layouts.app')


@section('content')
    <style>
        .acc_foot {
            border-top: 1px solid #ddd;
            padding-top: 10px;
            margin-top: 30px;
        }

        .menu-item-bar {
            background: #cccccc12;
            padding: 10px;
            border: 1px solid #ddd;
            cursor: grab;
            display: block;
        }

        .dragged {
            position: absolute;
            z-index: 1;
        }

        .placeholder {
            position: relative;
        }

        body.dragging,
        body.dragging* {
            cursor: move
        }

        ul form {
            width: 50%;
            background: #fff;
            padding: 10px;
        }

        #menuitems li {
            list-style: none;
        }
    </style>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel-tag">
                <form action="{{ route('menu.index') }}" class="">
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label" for="example-text-input">Select a menu to
                            edit:</label>
                        <div class="col-lg-8">
                            <select class="form-control" id="menu_cont" name="">
                                <option value="">-- select --</option>
                                @foreach ($menus as $item)
                                    <option
                                        @if ($selectedMenu != '') {{ $item->id == $selectedMenu->id ? 'selected' : '' }} @endif
                                        value="{{ $item->id }}">
                                        {{ $item->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <input id="menu_id" name="id" type="hidden"
                                value="{{ $selectedMenu != '' ? $selectedMenu->id : '' }}">
                            <button class="btn btn-primary btm-sm" type="submit" value="Select">submit</button>
                        </div>
                        {{-- <div class="col-lg-4">
                        or &nbsp;<a href="{{ route('menu_create') }}">create a new menu. </a>
                    </div> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-4">
            <h4>Add Menu Items</h4>
            <div class="accordion accordion-hover" id="js_demo_accordion-5">
                <div class="card">
                    <div class="card-header">
                        <a aria-expanded="true" class="card-title" data-target="#js_demo_accordion-5a"
                            data-toggle="collapse" href="javascript:void(0);">
                            <i class="fal fa-cog width-2 fs-xl"></i>
                            Pages
                            <span class="ml-auto">
                                <span class="collapsed-reveal">
                                    <i class="fal fa-chevron-up fs-xl"></i>
                                </span>
                                <span class="collapsed-hidden">
                                    <i class="fal fa-chevron-down fs-xl"></i>
                                </span>
                            </span>
                        </a>
                    </div>
                    <div class="collapse show" data-parent="#js_demo_accordion-5" id="js_demo_accordion-5a">
                        <div class="card-body" id="pages-list">
                            @foreach ($pages as $key => $item)
                                {{-- @php
                            $post = $item->translate('en');
                            //dd($item->translate('en'));
                            //dd($post);
                            $post_title = $item->post_title;
                            $post_id = $post->post_id;
                        @endphp --}}
                                <div class="custom-control custom-checkbox mb-2">
                                    <input class="custom-control-input" id="page{{ $key }}" name="select-page[]"
                                        type="checkbox" value="{{ $item->id }}">
                                    <label class="custom-control-label"
                                        for="page{{ $key }}">{{ $item->post_title }}</label>
                                </div>
                            @endforeach
                            <div class="acc_foot">
                                <div class="sub_foot d-flex justify-content-between align-items-center">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" id="check_select_all" type="checkbox"
                                            value="">
                                        <label class="custom-control-label" for="check_select_all">select all</label>
                                    </div>
                                    <button class="btn btn-sm btn-primary" id="add_all_page" type="button">Add To
                                        Menu</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <a aria-expanded="false" class="card-title collapsed" data-target="#js_demo_accordion-5b"
                            data-toggle="collapse" href="javascript:void(0);">
                            <i class="fal fa-code-merge width-2 fs-xl"></i>
                            Custom Links
                            <span class="ml-auto">
                                <span class="collapsed-reveal">
                                    <i class="fal fa-chevron-up fs-xl"></i>
                                </span>
                                <span class="collapsed-hidden">
                                    <i class="fal fa-chevron-down fs-xl"></i>
                                </span>
                            </span>
                        </a>
                    </div>
                    <div class="collapse" data-parent="#js_demo_accordion-5" id="js_demo_accordion-5b">
                        <form action="{{ route('add_custom_link') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="">
                                        <label for="link_url">URL</label>
                                        <input class="form-control cust_input" id="link_url" name="link_url"
                                            placeholder="https://" type="text">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="">
                                        <label for="link_txt">Link Text</label>
                                        <input class="form-control cust_input" id="link_txt" name="link_txt" placeholder=""
                                            type="text">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="text-end">
                                        <input name="menu_id" type="hidden"
                                            value="{{ $selectedMenu != '' ? $selectedMenu->id : '' }}">
                                        <button class="btn btn-sm btn-primary" type="submit">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-8">
            <h4>Menu Structure</h4>
            <!-- panel with everything disabled -->
            <div class="panel" data-panel-close data-panel-collapsed data-panel-color data-panel-custombutton
                data-panel-fullscreen data-panel-locked data-panel-refresh data-panel-reset id="panel-1">
                <div class="panel-hdr">
                    <h2>
                        Menu
                    </h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">

                        @if ($selectedMenu == '')
                            <h5 class="card-title">Card title</h5>


                            <form action="{{ route('menu_store') }}" class="form-inline d-flex justify-content-between"
                                method="post">
                                @csrf
                                <label class="mr-2" for="inputName">Menu Name:</label>
                                <input class="form-control" name="title" placeholder="Enter name" style="width: 550px"
                                    type="text">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </form>
                        @else
                            <h6>Add Pages to the menu</h6>
                            <ul class="nav nav-tabs nav-tabs-clean" role="tablist">
                                @foreach ($lang as $item)
                                    <li class="nav-item"><a class="nav-link {{ $item->id == 1 ? 'active' : '' }}"
                                            data-toggle="tab" href="#tab-{{ $item->lang_short_name }}"
                                            role="tab"><img alt="" src="/{{ $item->lang_flag }}"
                                                style="max-width: 20px; margin-right: 10px;">{{ $item->lang_name }}</a>
                                    </li>
                                @endforeach
                                {{-- <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab-en" role="tab">English</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-or" role="tab">Oriya</a></li> --}}
                            </ul>

                            <div class="tab-content p-3">
                                @foreach ($lang as $item1)
                                    @php
                                        //dd($item1);
                                    @endphp
                                    <div aria-labelledby="tab-{{ $item1->lang_short_name }}"
                                        class="tab-pane fade  {{ $item1->id == 1 ? 'show active' : '' }}"
                                        id="tab-{{ $item1->lang_short_name }}" role="tabpanel">

                                        <ul class="navbar-nav sortable-grid ui-sortable" id="menuitems">


                                            @foreach ($menuItems as $key => $item)
                                                @php

                                                    //dd($item);
                                                   // dd($menuItems->SetTrans());
                                                    //dd($item->id);
                                                    // dd($item->getTranslation('title',$lang_title));
                                                    // dd($item->translate('en'));

                                                    // dd($item->translate('en'));

                                                    $lang_title = $item1->lang_short_name;
                                                    // dd($item->id);

                                                    //  $post = $item->translate($lang_title);
                                                    // dd($item->getTranslation('title',$lang_title));
                                                    // $post_tilte = $post->title;
                                                @endphp

                                                <li class="ui-sortable-handle" data-id="{{ $item->id }}"><span
                                                        class="menu-item-bar mb-2"><a
                                                            data-target="#collapseMenu{{ $item->id }}"
                                                            data-toggle="collapse">{{ MenuItem($item->id,'name',$lang_title) != '' ? MenuItem($item->id,'name',$lang_title) : MenuItem($item->id,'title',$lang_title) }}
                                                            <i class="fa fa-caret-down float-end"></i></a></span>
                                                    <div class="collapse" id="collapseMenu{{ $item->id }}">
                                                        <form action="{{ route('update_menu', [$lang_title, $item->id]) }}"
                                                            method="post">
                                                            @csrf
                                                            <div class="form-group">
                                                                <p><label for="">Link Name</label></p>
                                                                <input class="form-control" name="link_txt"
                                                                    type="text"
                                                                    value="{{ MenuItem($item->id,'name',$lang_title) != '' ? MenuItem($item->id,'name',$lang_title) : MenuItem($item->id,'title',$lang_title) }}">
                                                            </div>
                                                            @if ($item->type == 'custom')
                                                                <div class="form-group">
                                                                    <p><label for="">url</label></p>
                                                                    <input class="form-control"
                                                                        name="{{ $lang_title }}_link_url"
                                                                        type="text" value="{{ $item->slug }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input {{ $item->target == '_blank' ? 'checked' : '' }}
                                                                        class="" name="target" type="checkbox"
                                                                        value="_blank"> open in a new tab
                                                                </div>
                                                            @endif
                                                            <div class="form-group mt-2">
                                                                <button class="btn btn-sm btn-primary"
                                                                    type="submit">Save</button>
                                                                <a class="btn btn-sm btn-danger"
                                                                    href="{{ route('deleteMenuItem', [$item->id, $key, 'null', 'null']) }}">Delete</a>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    @if ($selectedMenu->content == '' || $selectedMenu->content == '[[]]')
                                                        <ul></ul>
                                                    @else
                                                        <ul>
                                                            @if ($item->children[0])
                                                                @foreach ($item->children[0] as $in => $child)

                                                                    <li data-id="{{ $child->id }}"> <span
                                                                            class="menu-item-bar mb-2">
                                                                            <a data-toggle="collapse"
                                                                            data-target="#collapseChild{{ $child->id }}">{{ MenuItem($child->id,'name',$lang_title) != '' ? MenuItem($child->id,'name',$lang_title) : MenuItem($child->id,'title',$lang_title) }}<i
                                                                                    class="fa fa-caret-down float-end"></i></a></span>
                                                                        <div class="collapse"
                                                                            id="collapseChild{{ $child->id }}">
                                                                            <form
                                                                                action="{{ route('update_menu', [$lang_title,$child->id]) }}"
                                                                                method="post">
                                                                                @csrf
                                                                                <div class="form-group">
                                                                                    <p><label for="">Link Name ||
                                                                                            {{ $child->type }}</label></p>
                                                                                    <input class="form-control"
                                                                                        name="link_txt" type="text"
                                                                                        value="{{ MenuItem($child->id,'name',$lang_title) != '' ? MenuItem($child->id,'name',$lang_title) : MenuItem($child->id,'title',$lang_title) }}">
                                                                                </div>
                                                                                @if ($child->type == 'custom')
                                                                                    <div class="form-group">
                                                                                        <p><label
                                                                                                for="">url</label>
                                                                                        </p>
                                                                                        <input class="form-control"
                                                                                            name="url" type="text"
                                                                                            value="{{ $child->slug }}">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <input
                                                                                            {{ $child->target == '_blank' ? 'checked' : '' }}
                                                                                            class="" name="target"
                                                                                            type="checkbox"
                                                                                            value="_blank"> open in a new
                                                                                        tab
                                                                                    </div>
                                                                                @endif
                                                                                <div class="form-group mt-2">
                                                                                    <button class="btn btn-sm btn-primary"
                                                                                        type="submit">Save</button>
                                                                                    <a class="btn btn-sm btn-danger"
                                                                                        href="{{ route('deleteMenuItem', [$child->id, $key, $in, 'null']) }}">Delete</a>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                        <ul>
                                                                            @if ($child->children[0])
                                                                                @foreach ($child->children[0] as $gkey => $grandchild)

                                                                                {{-- @php
                                                                                    dd($grandchild)
                                                                                @endphp --}}

                                                                                    <li data-id="{{ $grandchild->id }}">
                                                                                        <span class="menu-item-bar mb-2">
                                                                                            <a data-toggle="collapse"
                                                                                                data-target="#collapsegrandChild{{ $grandchild->id }}">{{ MenuItem($grandchild->id,'name',$lang_title) != '' ? MenuItem($grandchild->id,'name',$lang_title) : MenuItem($grandchild->id,'title',$lang_title) }}<i
                                                                                                    class="fa fa-caret-down float-end"></i></a></span>
                                                                                        <div class="collapse"
                                                                                            id="collapsegrandChild{{ $grandchild->id }}">
                                                                                            <form
                                                                                                action="{{ route('update_menu', [$lang_title,$grandchild->id]) }}"
                                                                                                method="post">
                                                                                                @csrf
                                                                                                <div class="form-group">
                                                                                                    <p><label
                                                                                                            for="">Link
                                                                                                            Name || {{$grandchild->type}}</label>
                                                                                                    </p>
                                                                                                    <input
                                                                                                        class="form-control"
                                                                                                        name="link_txt"
                                                                                                        type="text"
                                                                                                        value="{{ MenuItem($grandchild->id,'name',$lang_title) != '' ? MenuItem($grandchild->id,'name',$lang_title) : MenuItem($grandchild->id,'title',$lang_title) }}">
                                                                                                </div>
                                                                                                @if ($grandchild->type == 'custom')
                                                                                                    <div
                                                                                                        class="form-group">
                                                                                                        <p><label
                                                                                                                for="">url</label>
                                                                                                        </p>
                                                                                                        <input
                                                                                                            class="form-control"
                                                                                                            name="link_txt"
                                                                                                            type="text"
                                                                                                            value="{{ $grandchild->slug }}">
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-group">
                                                                                                        <input
                                                                                                            {{ $grandchild->target == '_blank' ? 'checked' : '' }}
                                                                                                            class=""
                                                                                                            name="target"
                                                                                                            type="checkbox"
                                                                                                            value="_blank">
                                                                                                        open in a new tab
                                                                                                    </div>
                                                                                                @endif
                                                                                                <div
                                                                                                    class="form-group mt-2">
                                                                                                    <button class="btn btn-sm btn-primary"
                                                                                                        type="submit">Save 2</button>
                                                                                                    <a class="btn btn-sm btn-danger"
                                                                                                        href="{{ route('deleteMenuItem', [$grandchild->id, $key, $in, $gkey]) }}">Delete</a>
                                                                                                </div>
                                                                                            </form>
                                                                                        </div>
                                                                                    </li>
                                                                                @endforeach
                                                                            @endif
                                                                        </ul>
                                                                    </li>
                                                                @endforeach
                                                            @endif
                                                        </ul>
                                                    @endif

                                                </li>
                                            @endforeach
                                        </ul>

                                    </div>
                                @endforeach


                                {{-- <button type="submit" class="btn btn-sm btn-primary mt-4">save</button> --}}
                            </div>


                            <div class="text-end mt-4">
                                <button class="btn btn-sm btn-primary" id="savemenu" type="submit">Save Menus</button>
                                <a class="btn btn-sm btn-danger"
                                    href="{{ route('deleteMenu', [$selectedMenu->id]) }}">Delete Menu</a>
                            </div>

                            <div id="serialize_output"></div>

                            <div class="form-group mt-4">
                                <p><b>Menu Location:</b></p>
                                {{-- @php
                                    dd($selectedMenu->location);
                                @endphp --}}

                                <p>

                                <div class="custom-control custom-radio">
                                    <input
                                        @if ($selectedMenu != '') {{ $selectedMenu->location == 'header' ? 'checked' : '' }} @endif
                                        class="custom-control-input" id="header" name="location" type="radio"
                                        value="header">
                                    <label class="custom-control-label" for="header">Header</label>
                                </div>
                                </p>
                                <p>
                                <div class="custom-control custom-radio">
                                    <input
                                        @if ($selectedMenu != '') {{ $selectedMenu->location == 'mian_menu' ? 'checked' : '' }} @endif
                                        class="custom-control-input" id="mian_menu" name="location" type="radio"
                                        value="mian_menu">
                                    <label class="custom-control-label" for="mian_menu">Main menu</label>
                                </div>
                                </p>
                                <p>
                                <div class="custom-control custom-radio">
                                    <input
                                        @if ($selectedMenu != '') {{ $selectedMenu->location == 'footer' ? 'checked' : '' }} @endif
                                        class="custom-control-input" id="footer" name="location" type="radio"
                                        value="footer">
                                    <label class="custom-control-label" for="footer">Footer</label>
                                </div>
                                </p>
                            </div>
                        @endif



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/backend/js/jquery-sortable.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#check_select_all').click(function(event) {
                alert('Please Ensure You Selet Menu');
                if (this.checked) {
                    $("#pages-list input[type='checkbox']").prop('checked', true);
                } else {
                    $("#pages-list input[type='checkbox']").prop('checked', false);
                }
            });


            $('#menu_cont').change(function() {
                $('#menu_id').val($(this).val());
            });



            $('#add_all_page').click(function() {

               
                let menu_id = $('#menu_id').val();
                

                let menu_length = $('input[name="select-page[]"]:checked').length;
               // alert(menu_length);
                let menu_array = $('input[name="select-page[]"]:checked');
               
                let ids = [];
                for (i = 0; i < menu_length; i++) {
                    ids[i] = menu_array.eq(i).val();
                }

                if (ids.length == 0) {
                    return false;
                    // alert(ids.length);
                } else {
                    // alert(ids.length);
                    $.ajax({
                        type: 'get',
                        url: "{{ route('addPageToMenu') }}",
                        data: {
                            'menu_id': menu_id,
                            'ids': ids,
                            '_token': '{{ csrf_token() }}'
                        },

                        success: function(data) {

                            console.log(data);

                            // location.reload();
                        }
                    });
                }
            });

            // code for sortable menu===============
            let group = $('#menuitems').sortable({
                group: 'serialzation',
                onDrop: function($item, $container, _super) {
                    let data = group.sortable('serialize').get();
                    let jsonString = JSON.stringify(data, null, '');
                    $('#serialize_output').text(jsonString);
                    _super($item, $container);
                }
            });
            //    End sortable menu ==========

            $('#savemenu').click(function() {
                // alert('1233');
                let menu_id = $('#menu_id').val();
                let new_content = $('#serialize_output').text();
                let location = $('input[name="location"]:checked').val();
                //alert(location);
                if (new_content.length > 0) {
                    //alert('456');
                    var data = JSON.parse($('#serialize_output').text());
                    $.ajax({
                        'type': 'post',
                        'url': "{{ route('save_menu') }}",
                        'data': {
                            'menu_id': menu_id,
                            'new_content': new_content,
                            'location': location,
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function(value) {
                            console.log(value);
                            // location.reload();
                            // location.reload(true);
                            window.location.reload();
                        }
                    });
                } else {

                    $.ajax({
                        'type': 'post',
                        'url': "{{ route('save_menu') }}",
                        'data': {
                            'menu_id': menu_id,
                            'new_content': new_content,
                            'location': location,
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function(value) {
                            console.log(value);
                            //location.reload();
                            //location.reload(true);
                            window.location.reload();
                        }
                    });
                }
            });

            // add custom link to menu

            // end custom link to menu

        });
    </script>
@endsection
