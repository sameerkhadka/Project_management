@extends('layouts.app')
@section('content') 
        <div class="content">
            <div class="table-wrap">
                <h5 class='table-head'>Company</h5>
                <table class="list-task">
                    <tr>
                        <th>SN</th>
                        <th>Company</th>
                        @if(auth()->user()->isAdmin())
                        <th>Edit</th>
                        <th>Delete</th>
                        @endif
                    </tr>
                    @foreach($companies as $company)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td> <a href="/companytask/{{ $company->id }}">{{ $company->name }}</a>
                        </td>
                        @if(auth()->user()->isAdmin())
                        <td><a href="{{route('companies.edit', $company->id)}}"><i class="far fa-edit"></i></a> </td>
                        <td><button onclick="handleDelete({{ $company->id  }})"><i class="far fa-trash-alt"></i></button></td>
                        @endif
                    </tr>
                    @endforeach

                </table>
            </div>
        </div>

         <!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModallabel" aria-hidden="true">
  <div class="modal-dialog">
        <form action="" method="POST" id="deleteCompanyForm">
        
        @csrf
        
        @method('DELETE')
       
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel">Delete Company</h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
             <span aria-hidden="true"></span>
             </button>
      </div>
      <div class="modal-body">
        <p class="text-center text-bold"> Are you sure you want to delete???</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go Back</button>
        <button type="submit" class="btn btn-danger">Yes, Delete</button>
      </div>
    </div>
        
        </form>
  </div>
</div>

    </div>
@endsection

@section('scripts')

    <script>
    
        function handleDelete(id) {
    
            var form = document.getElementById('deleteCompanyForm')        

            form.action = '/companies/' + id       

            $('#deleteModal').modal('show')        

        }
    
    </script>

@endsection