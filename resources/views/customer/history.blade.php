@extends('layouts.customer.customerlayout')

@section('title')
    My Transection History
@endsection



@section('customercontent')
    <div class="flex-container">
        <div class="flex-item" style="width: 85%; margin-left:150px;">
            <table id="transactions" class="table table-hover">
                <tr>
                    <th>Date & Time (+6.00)<a href="/account/my-transections/historydate"><div><i class="fas fa-sort" style="font-size: 20px; justify-content:right;"></i></div></a></th>
                    <th>Remarks <a href="/account/my-transections/remarks"><div><i class="fas fa-sort" style="font-size: 20px; justify-content:right;"></i></div></a></th>
                    <th>Debit (TK) <a href="/account/my-transections/debit"><div><i class="fas fa-sort" style="font-size: 20px; justify-content:right;"></i></div></a></th>
                    <th>Credit (TK) <a href="/account/my-transections/credit"><div><i class="fas fa-sort" style="font-size: 20px; justify-content:right;"></i></div></a></th>
                </tr>
                @forelse ($history as $h)
                    <tr>
                        <td>{{ $h->created_at }}</td>
                        <td>{{ $h->remarks }}</td>
                        <td>{{ $h->debit }}</td>
                        <td>{{ $h->credit }}</td>
                    </tr>
                @empty
                    <p id="none"> No results found :(</p>
                @endforelse
            </table>
        </div>
    </div>
    
@endsection