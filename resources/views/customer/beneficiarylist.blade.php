@extends('layouts.customer.beneficiarylayout')

@section('title')
    Beneficiary List
@endsection

@section('beneficiarycontent')
    <div class="flex-container-ben">
        <p id="info">Transfer Funds to a Beneficiary</p>
        @forelse ($beneficiaries as $b)
            <div class="flex-item-ben">
                <div class="flex-item-ben-2">
                    <p id="name">{{ $b->beneficiaryname }}</p>
                    <br>
                    <p id="acno">Acc/Name: {{ $b->accountname }}</p>
                </div>
                <div class="flex-item-ben-1;">
                    <br>
                    <a href="/account/tranfer-fund/{{ $b->id }}">
                        <div class="btn btn-outline-dark" style="width:200px; margin-left:-50px; margin-right:10px;">
                            <i class="fas fa-paper-plane"></i><strong> Send Money</strong>
                        </div>
                    </a>
                    <br>
                    <a href="">
                        <div class="btn btn-outline-dark" onclick="confirmdelete({{ $b->id }})" style="width:200px; margin-top:5px; margin-left:-50px; margin-right:10px;">
                            <i class="fas fa-trash"></i><strong> Delete Beneficiary</strong>
                        </div>
                    </a>
                </div>
            </div>
        @empty
            <div class="flex-item-ben">
                <div class="flex-item-ben-2">
                    <p id="name">Sorry</p>
                    <br>
                    <p id="acno">You have no beneficiaries</p>
                </div>
            </div>
        @endforelse
        <script>
            function confirmdelete(id) {
                var r = confirm("Are you sure want to delete the Beneficiary?");
                if (r == true) {
                    window.location="/account/delete/"+id;
                }
            }
        </script>
    </div>

@endsection