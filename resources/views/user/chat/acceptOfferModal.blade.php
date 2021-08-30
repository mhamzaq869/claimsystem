<!-- Accept Offer Modal -->
<div class="modal fade" id="stripe{{$chats->first()->contract_id}}" tabindex="-1" role="dialog"
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
        <form method="POST" action="{{ route('proposal.accept', [$chats->first()->contract_id]) }}" id="form{{$chats->first()->contract_id}}">
            @csrf
            <input type="hidden" name="project_id" value="{{ $chats->first()->contract_id }}">
            <input type="hidden" name="req_by_user" id="offerVendor">
            <input type="hidden" name="price" id="offerPrice">
            <input type="hidden" name="delivery" id="offerDelivery">
            <input type="hidden" name="message_id" id="msg_id">
            <input type="hidden" name="note" id="note_id">

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
                            <sup class="dollar font-weight-bold">$</sup>
                            <span class="amount ml-1 mr-1" id="amount"></span>
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
        </form>
            {{-- </div> --}}
        </div>
    </div>
</div>
