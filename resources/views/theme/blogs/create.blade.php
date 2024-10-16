@extends('theme.master')
@section('title','New Blog')


@section('content')
 
  <!--================ Hero sm banner start =================-->  
  @include('theme.partials.hero',['title'=>'Add Your New Blog'])
  <!--================ Hero sm banner end =================-->  

  <!-- ================ contact section start ================= -->
  <section class="section-margin--small section-margin">
    <div class="container">
      <div class="row">
        <div class="col-12">
          @if (session('blogCreatedStatus'))
            <div class="alert alert-success">
                {{ session('blogCreatedStatus') }}
            </div>
          @endif
          <form action="{{ route('blogs.store') }}" class="form-contact contact_form"   method="POST"  novalidate="novalidate" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <input class="form-control border" name="name" id="name" type="text" placeholder="Enter your blog title :" value="{{ old('name') }}">
              <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div class="form-group">
              <input class="form-control border" name="image" id="name" type="file">
              <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>
            <div class="form-group">
              <select class="form-control border" name="category_id">
                <option value="">Select Category</option>
                @if (count($categories)>0)

                @foreach ( $categories as $category )
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
                  
                @endif
              </select>
              <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
            </div>
            <div class="form-group">
              <textarea class="w-100 border" name="description" rows="5">
                {{ old('description') }}
              </textarea>
              <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
            <div class="form-group text-center text-md-right mt-3">
              <button type="submit" class="button button--active button-contactForm">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
	<!-- ================ contact section end ================= -->

@endsection