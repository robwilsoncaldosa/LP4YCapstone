<!--********************************************* CONTACT *******************************************-->
<section class="contact " id="contact">
    <br>
    <br>
    <br>
    <h2 class="text-center">Contact Us</h2>
    <br>
    <div class="contact-details d-flex  justify-content-between align-items-center">
        <h5>host4change.cebu@lp4y.org</h5>
        <h5>/</h5>
        <h5>A. Tumulak street, Barangay Gun-Ob<br>

            Lapu-Lapu Cebu, Cebu, 6015

        </h5>
        <h5>/</h5>
        <h5>Tel: 0910 451 0420</h5>
    </div>
    <br>
    <br>
    {{-- <!-- Include any error messages -->
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif --}}
    <div class="container">
        <form class="contact-form" action="{{ route('sendemail') }}" method="POST" >
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Enter Your Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Enter Your Email*</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="subject">Enter Your Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
                        @error('subject')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="message">Enter Your Message</label>
                        <textarea class="form-control" id="message" name="message" placeholder="Message" rows="5" required></textarea>
                        @error('message')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn bg-black text-white w-100">Submit</button>
        </form>

    </div>


    <iframe
        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d490.68891707319847!2d123.9490603791058!3d10.300900522871656!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a9999278be73df%3A0x375659c7ec469226!2sLife%20Project%204%20Youth%20(LP4Y)%20-%20Center%20and%20Guest%20houses!5e0!3m2!1sen!2sph!4v1688547750578!5m2!1sen!2sph"
        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
</section>
<br>
<br>
