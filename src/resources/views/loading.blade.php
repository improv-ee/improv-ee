<div class="row spinner-center align-items-center">
    <div class="col-4 offset-4">
        <div class="half-circle-spinner">
            <div class="circle circle-1"></div>
            <div class="circle circle-2"></div>
        </div>
    </div>
</div>

@section('styles')
    @parent
    <style type="text/css">

        .spinner-center {
            height: 40rem;
        }

        .half-circle-spinner, .half-circle-spinner * {
            box-sizing: border-box;
        }

        .half-circle-spinner {
            width: 160px;
            height: 160px;
            border-radius: 100%;
            position: relative;
        }

        .half-circle-spinner .circle {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 100%;
            border: calc(60px / 10) solid transparent;
        }

        .half-circle-spinner .circle.circle-1 {
            border-top-color: #9933CC;
            animation: half-circle-spinner-animation 1s infinite;
        }

        .half-circle-spinner .circle.circle-2 {
            border-bottom-color: #9933CC;
            animation: half-circle-spinner-animation 1s infinite alternate;
        }

        @keyframes half-circle-spinner-animation {
            0% {
                transform: rotate(0deg);

            }
            100%{
                transform: rotate(360deg);
            }
        }
    </style>
@endsection
