@extends('layouts.main')

@section('title', __('Home'))
@section('content')

@if(!auth()->user() ||  !auth()->user()->isAdmin())
   <script>
      window.location.replace('/')
   </script>
@endif
<!--header-->
<div class="header2 text-center"></div>
<!--header//-->
@include('components.admin_sub_nav')

      <div class="main-content-admin container">
       <table id="contactUs" class="table table-striped table-bordered dt-responsive" style="width:100%">
            <thead>
               <tr>
                  <th>{{ __('Name') }}</th>
                  <th>{{ __('Email') }}</th>
                  <th>{{ __('Message') }}</th>
                  <th>{{ __('Date') }}</th>
               </tr>
            </thead>
            <tbody></tbody>
         </table>
      </div>
      <script>
          getContacts();
         function getContacts(){
            $.ajax({
               type: "get",
               url: '/contacts',
               success: function(res) 
                  {
                     $('#contactUs tbody').empty();
                      res.data.forEach(function(contact){
                        $('#contactUs tbody').append(
                           '<tr>'+
                              '<td>'+contact.name+'</td>'+
                              '<td>'+contact.email+'</td>'+
                              '<td>'+contact.message+'</td>'+
                              '<td>'+contact.created_at+'</td>'+
                           '</tr>'
                        )
                     })
                     $('#contactUs').DataTable({
                        "initComplete": function(settings, json) {
                           $('table#contactUs').parent().addClass('dataTableFirstWrapper')
                        }
                     });

                  },
                  error: function(){
                  $('#contactUs').DataTable({
                        "initComplete": function(settings, json) {
                           $('table#contactUs').parent().addClass('dataTableFirstWrapper')
                        }
                     });
                     alert('failure');
                  }
               });
               
         }
       
      </script>


@endsection