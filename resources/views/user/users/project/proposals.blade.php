@extends('user.layouts.master')

@section('main-content')

    <style>
        .card {
            border: none;
            border-radius: 8px;
        }

        .heading {
            font-size: 23px;
            font-weight: 00
        }

        .text {
            font-size: 16px;
            font-weight: 500;
            color: #b1b6bd
        }

        .pricing {
            border: 2px solid #304FFE;
            background-color: #f2f5ff
        }

        .business {
            font-size: 20px;
            font-weight: 500
        }

        .plan {
            color: #aba4a4
        }

        .dollar {
            font-size: 16px;
            color: #6b6b6f
        }

        .amount {
            font-size: 30px;
            font-weight: 500
        }

        .year {
            font-size: 20px;
            color: #6b6b6f;
            margin-top: 19px
        }

        .detail {
            font-size: 22px;
            font-weight: 500
        }

        .cvv {
            height: 44px;
            width: 73px;
            border: 2px solid #eee
        }

        .cvv:focus {
            box-shadow: none;
            border: 2px solid #304FFE
        }

        .email-text {
            height: 55px;
            border: 2px solid #eee
        }

        .email-text:focus {
            box-shadow: none;
            border: 2px solid #304FFE !important;
        }

        .payment-button {
            height: 70px;
            font-size: 20px
        }

    </style>
    <!-- DataTales Example -->
    <h5 class="mb-3 display-4">Proposals Recived</h5>
    <div class="table-responsive">
        @if (Session::has('message'))
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ Session::get('message') }}
            </div>
        @endif
        @if (Session::has('danger'))
        <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('danger') }}
        </div>
         @endif
        @if (count($proposals) > 0)
            <table class="table table-bordered" id="order-dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Vendor</th>
                        <th>Vendor Location</th>
                        <th>Project Title</th>
                        <th>Cover Letter</th>
                        <th>Price</th>
                        <th>Days To Complete</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proposals as $key => $proposal)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $proposal->user->name }}</td>
                            <td>{{ $proposal->user->preff_location ?? 'N/A' }}</td>
                            <td>{{ $proposal->project->title }}</td>
                            <td>{{ $proposal->cover_letter }}</td>
                            <td>R.s {{ $proposal->price }}</td>
                            <td>{{ $proposal->days }}</td>
                            <td style="width:100px">
                                @if (!empty(
            App\Models\Contract::where('project_id', $proposal->project_id)->where('req_by_user', $proposal->user_id)->first()->project_id
        ) == $proposal->project_id)
                                    <i class="fa fa-check-circle text-success"></i> Accepted
                                @else
                                    <form method="POST" action="{{ route('bid.proposal.accept', [$proposal->id]) }}"
                                        id="form{{ $proposal->id }}">
                                        @csrf
                                        <input type="hidden" name="project_id" value="{{ $proposal->project->id }}">
                                        <input type="hidden" name="bid_id" value="{{ $proposal->id }}">
                                        <input type="hidden" name="req_by_user" value="{{ $proposal->user->id }}">
                                        <input type="hidden" name="price" value="{{ $proposal->price }}">
                                        <input type="hidden" name="delivery" value="{{ $proposal->days }}">

                                        <button class="btn-success btn-sm" type="button" onclick="formSubmit({{$proposal->id}});"
                                        data-toggle="modal" data-target="#stripe{{$proposal->id}}"
                                        data-placement="bottom" title="Accept">Accept</button>


                                        <!-- Modal -->
                                        <div class="modal fade" id="stripe{{$proposal->id}}" tabindex="-1" role="dialog"
                                            aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">

                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    {{-- <div class="modal-body"> --}}

                                                    <div class="mt-5 mb-5 d-flex justify-content-center">
                                                        <div class="card p-4">
                                                            <div>
                                                                <h4 class="heading">Pay Amount Before Accept</h4>
                                                                <p class="text">Please make the payment to start monitoring
                                                                    and conversation with vendor</p>
                                                            </div>
                                                            <div
                                                                class="pricing p-3 rounded mt-4 d-flex justify-content-between">
                                                                <div class="images d-flex flex-row align-items-center"> <img
                                                                        src="{{asset('frontend/img/bank.png')}}"
                                                                        class="rounded" width="60">
                                                                    <div class="d-flex flex-column ml-4"> <span
                                                                            class="business">Buy Service</span>
                                                                        <span class="plan"></span>
                                                                    </div>
                                                                </div>
                                                                <!--pricing table-->
                                                                <div class="d-flex flex-row align-items-center">
                                                                    <sup class="dollar font-weight-bold">Rs.</sup>
                                                                    <span class="amount ml-1 mr-1" id="amount">{{ $proposal->price }}</span>
                                                                </div> <!-- /pricing table-->
                                                            </div> <span class="detail mt-5">Payment details</span>
                                                            <!----stripe element---->

                                                            <div class="form-group mt-2">
                                                                 <input type="hidden" name="client_secret" id="client_secret"
                                                                    value="{{ $intent->client_secret }}">
                                                                <div id="card-element"
                                                                    class="p-3 email-text bg-white rounded">
                                                                </div>

                                                                <!-- Used to display form errors. -->
                                                                <div id="card-errors" class="text-danger" role="alert">
                                                                    @error('cardnumber') <p class="text-danger">
                                                                        {{ $message }}</p> @enderror
                                                                </div>

                                                            </div>

                                                            <!----end stripe element---->

                                                            <div class="mt-3">
                                                                <button type="submit" class="btn btn-primary btn-block payment-button">Proceed
                                                                    to payment
                                                                <i class="fa fa-long-arrow-right"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <span style="float:right">{{ $proposals->links() }}</span>
        @else
            <h6 class="text-center">No orders found!!! Please order some products</h6>
        @endif
    </div>

<script src="https://js.stripe.com/v3/"></script>


<script>


// Create a Stripe client.
var stripe = Stripe("{{ env('STRIPE_KEY') }}");
// console.log(stripe.elements());
// Create an instance of Elements.
var elements = stripe.elements();
// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
    base: {
        color: '#32325d',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
            color: '#aab7c4'
        }
    },
    invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
    }
};
// Create an instance of the card Element.
var card = elements.create('card', {
    hidePostalCode: true,
    style: style
});
// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');
// Handle real-time validation errors from the card Element.
card.on('change', function(event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
});



// Handle form submission.
function formSubmit(id){
    var form = document.getElementById('form'+id);
    // console.warn(form)
    form.addEventListener('submit', function(event) {
        // console.log(form);
        const cardButton = document.getElementById('client_secret');
        const clientSecret = cardButton.getAttribute('value');
        event.preventDefault();
        stripe.createToken(card).then(function(result) {
            var hiddenCardInput = document.createElement('input');
            hiddenCardInput.setAttribute('type', 'hidden');
            hiddenCardInput.setAttribute('name', 'cardMethod');
            hiddenCardInput.setAttribute('value', result.token.id);
            form.appendChild(hiddenCardInput);
        });
        stripe.handleCardSetup(clientSecret, card, {
                payment_method_data: {}
            })
            .then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    form.submit();
                }
            });
    });

}

</script>

@endsection

@push('styles')
    <link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <style>
        div.dataTables_wrapper div.dataTables_paginate {
            display: none;
        }

    </style>

@endpush
