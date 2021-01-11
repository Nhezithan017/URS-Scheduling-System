$(document).ready(function(){

      setTimeout(function(){
            $("div.alert").remove();
          }, 5000);

    function clear_icon()
    {
    $('#id_icon').html('');
     $('#post_title_icon').html('');
    }
    
   
    $(document).on('keyup', '#search', function(){
     var query = $('#search').val();
     var column_name = $('#hidden_column_name').val();
     var sort_type = $('#hidden_sort_type').val();
     var page = $('#hidden_page').val();
     fetch_data(page, sort_type, column_name, query);
    });
    
    $(document).on('click', '.sorting', function(){
     var column_name = $(this).data('column_name');
     var order_type = $(this).data('sorting_type');
     var reverse_order = '';
     if(order_type == 'asc')
     {
      $(this).data('sorting_type', 'desc');
      reverse_order = 'desc';
      clear_icon();
      $('#'+column_name+'_icon').html('<i class="fas fa-arrow-up"></i>');
     }
     if(order_type == 'desc')
     {
      $(this).data('sorting_type', 'asc');
      reverse_order = 'asc';
      clear_icon();
      $('#'+column_name+'_icon').html('<i class="fas fa-arrow-down"></i>');
     }
     $('#hidden_column_name').val(column_name);
     $('#hidden_sort_type').val(reverse_order);
     var page = $('#hidden_page').val();
     var query = $('#search').val();
     fetch_data(page, reverse_order, column_name, query);
    });
    
    $(document).on('click', '.pagination a', function(event){
     event.preventDefault();
     var page = $(this).attr('href').split('page=')[1];
     $('#hidden_page').val(page);
     var column_name = $('#hidden_column_name').val();
     var sort_type = $('#hidden_sort_type').val();
    
     var query = $('#search').val();
    
     $('li').removeClass('active');
           $(this).parent().addClass('active');
     fetch_data(page, sort_type, column_name, query);
    });
    
    //rbi

      //query relation
      function fetch_relation(query)
      {
       $.ajax({
        url:"/store-head/relationship?query="+query,
        success:function(data)
        {
         $('#relationship').html('');
         $('#relationship').html(data);
        }
       });
      }
  
      //event relation
      $(document).on('change', '#gender',  function(){
          var query = $('#gender').val();
  
          fetch_relation(query);
      });
  
      
      //query data
      function fetch_data(query)
      {
       $.ajax({
        url:"/head/search?query="+query,
        success:function(data)
        {
         $('#search-data').html('');
         $('#search-data').html(data);
        }
       });    
      }
      
      //event data
          $(document).on('keyup', '#search', function(){
              var query = $('#search').val();
          
          fetch_data(query);
          });
  
          //search head
          function fetch_head(head)
      {
       $.ajax({
        url:"/head/search/fullname?head="+head,
        success:function(data)
        {
         $('#fullname').html('');
         $('#fullname').html(data);
        }
       });    
      }
      //event head
          $(document).on('change', '#head_id',  function(){
          var head = $('#head_id').val();
            
          fetch_head(head);
      });
    });