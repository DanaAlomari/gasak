@extends('front_end_layouts.app_layout')

@section('content')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 offset-lg-2 text-center">
            <div class="breadcrumb-text">
              <p>Services</p>
              <h1>Appointment Form</h1>
            </div>
          </div>
        </div>
      </div>
    </div>

	<div class="row">
		<div class="col-md-4 pt-5 mt-2">
			<img src="https://png.pngtree.com/png-clipart/20210129/ourlarge/pngtree-maintenance-worker-png-image_2816225.jpg" alt="">
		</div>
		<div id="Appointment-Calendar" class="col-md-8 mt-5">
		  <form action="{{route('createServices')}}" method="POST" class="fform">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    Name:
                    <input
                    type="text"
                    name="name"
                    class="form-control"
                    placeholder="Enter Full name (e.g: John Doe)"
                    onfocus="this.placeholder = ''"
                    onblur="this.placeholder = 'Enter Full name (e.g: John Doe)'" required/>
                </div>
                <div class="col-md-12">
                    Date: <input id="datePicker" class="form-control" type="date" name="date" value="" required/>
                </div>
                <div class="col-md-12">
                    Start Time: <input type="time" class="form-control" name="startTime" value="Start" required/>
                </div>
                <div class="col-md-12">
                    End Time: <input type="time" class="form-control" name="endTime" value="End" required/>
                </div>
                <div class="col-md-12">
                    Email:
                    <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="Johndoe@gmail.co.uk"
                    onfocus="this.placeholder = ''"
                    onblur="this.placeholder = 'Johndoe@gmail.co.uk'" required/>
                </div>
                <div class="col-md-12">
                    Description:
                    <textarea
                    name="description"

                    class="form-control"
                    placeholder="Description goes here"
                   
                    required></textarea>
                </div>
                <div class="col-md-4 mt-2">
                    <button type="submit" class="btn btn-md btn-warning" id="submit-button">Submit Appointment</button>
                </div>
            </div>
		  </form>
		</div>
	</div>

@endsection
