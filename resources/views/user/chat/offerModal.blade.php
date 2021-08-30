
        <!-- Offer Modal -->
        <div class="modal fade" id="offer" tabindex="-1" role="dialog"
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
                        <div class="card p-4 bg-light">
                            <h4 class="float-right">Send Offer</h4>
                            <div class="pricing p-3 rounded d-flex justify-content-between">

                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="detail mt-5">Payment:</span>
                                        <div class="form-group mt-2">
                                            <input type="number" name="offer" class="form-control bg-white shadow-sm" id="offeredPrice" placeholder="Enter Amount">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <span class="detail mt-5">Days:</span>
                                        <div class="form-group mt-2">
                                            <input type="number" name="days" class="form-control bg-white shadow-sm" id="offerDays" placeholder="Enter Days">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <span class="detail mt-5">Note:</span>
                                            <textarea name="note" id="note" class="form-control" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <button class="btn btn-primary btn-block payment-button" onclick="clicks()">
                                            Send Offer
                                        <i class="fas fa-long-arrow-right"></i>
                                        </button>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


<script>

    function clicks (){

    var offer = $("#offeredPrice").val()
    var days  = $("#offerDays").val()
    var note  = $("#note").val()
    var notes  = "'"+$("#note").val()+"'"


    let msg = $("#message").val();
    let user = {{Auth::user()->id}}
    let to_user = {{$chats->last()->toUser->id}}
    let token = "{{csrf_token()}}"
    let data  = [offer,days,to_user]
    let project = "{{$chats->first()->contract_id}}"
    let auth  = {{($chats->first()->user_id == Auth::user()->id)}}


    var html = '<div class="card"> <div class="card-body"><div class="row"><div class="col-md-12">';
        html += '<h5 class="text-dark">Price:$'+offer+' - Days('+days+')</h5>'
        html += '<div class="mt-2"><h5 class="text-left">Note:</h5><p class="mb-4 bg-white text-dark">'+note+'</p>'
        html += '<button class="btn-success btn-sm" type="button" id="user-'+{{Auth::user()->id}}+'" onclick="formSubmit({{$chats->first()->contract_id}},'+data+','+notes+')"'
        html += 'data-toggle="modal" data-target="#stripe{{$chats->first()->contract_id  ?? ''}}"'
        html += 'data-placement="bottom" title="Accept">Accept Offer</button>'
        html += '</div></div></div></div></div>'

    $.ajax({
            type:'POST',
            url:'/sendOffer',
            data:{_token:token,to_user:to_user,html:html,contract_id:project},

    });

    $("#offer").modal("hide")

    }


</script>
