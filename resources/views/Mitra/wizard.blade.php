@extends('index')
@section('content')
    @push('page-style')
        <!-- Masukkan link ke library jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Masukkan link ke library Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    @endpush
    <div class="col-12">
        <div class="card">
            <div class="card-body wizard-content">
                <h4 class="card-title">Custom Design Example</h4>
                <h6 class="card-subtitle"></h6>
                <form action="/test/tes" method="post" class="tab-wizard wizard-circle" id="wizardForm">
                    @csrf
                    <!-- Step 1 -->
                    <!-- Step 1 -->
                    <!-- Langkah 1 -->
                    <div class="step">
                        <h3>Langkah 1</h3>
                        <input type="text" id="field1" name="field1" placeholder="Field 1">
                    </div>
                    <!-- Langkah 2 -->
                    <div class="step">
                        <h3>Langkah 2</h3>
                        <input type="text" id="field2" name="field2" placeholder="Field 2">
                    </div>
                    <!-- Tombol Navigasi -->
                    <div class="form-group">
                        <button type="button" id="prevBtn">Previous</button>
                        <button type="button" id="nextBtn">Next</button>
                        <button type="submit" id="submitBtn">Submit</button>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    @push('page-script')
        {{-- <script src="{{ asset('assets/js/wizard.js') }}"></script> --}}
        <!-- Masukkan link ke library Bootstrap JS -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <!-- Masukkan link ke library Bootstrap JS Popper -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


        <script>
            $(document).ready(function() {
                var currentStep = 0;
                var steps = $(".step");

                function showStep(step) {
                    steps.hide();
                    steps.eq(step).show();
                    if (step === 0) {
                        $("#prevBtn").hide();
                    } else {
                        $("#prevBtn").show();
                    }
                    if (step === steps.length - 1) {
                        $("#nextBtn").hide();
                        $("#submitBtn").show();
                    } else {
                        $("#nextBtn").show();
                        $("#submitBtn").hide();
                    }
                }

                showStep(currentStep);

                $("#nextBtn").click(function() {
                    currentStep++;
                    showStep(currentStep);
                });

                $("#prevBtn").click(function() {
                    currentStep--;
                    showStep(currentStep);
                });

                $("#wizardForm").submit(function(e) {
                    e.preventDefault();

                    var formData = $(this).serialize();
                    console.log(formData);

                    $.ajax({
                        type: 'POST',
                        url: '/test/tes', // Replace with the appropriate URL
                        data: formData,
                        success: function(response) {
                            // Handle the server's response here
                            alert("Form submitted successfully.");
                        },
                        error: function(xhr, status, error, response) {
                            console.log(response);
                            alert("Error: " + error);
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
