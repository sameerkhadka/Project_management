@extends('layouts.app')
@section('content')
<div class="content">
            <div class="table-wrap">
                <h5 class='table-head'>Company</h5>
                <form action="{{ route('companies.update' , $company->id) }}" method=POST>
                    @csrf
                    @method('PUT')
                <table class="list-task">
                    <tr>
                        <th>SN</th>
                        <th>Company</th>
                        <th>Update</th>
                    </tr>

                    <tr>
                        <td>1</td>
                        <td><input type="text" value="{{ $company->name }}" name="name"></td>
                        <td><button><i class="far fa-edit"></i>Update</button> </td>
                    </tr>
                </form>
                </table>
            </div>
        </div>

    </div>
@endsection