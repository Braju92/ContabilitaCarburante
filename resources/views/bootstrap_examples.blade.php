FORM STANDARD

<div class="form-group">
    <label for="exampleFormControlInput1">Cedola</label>
    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="IDCedola">
</div>
<div class="form-group">
    <label for="exampleFormControlSelect1">Example select</label>
    <select class="form-control" id="exampleFormControlSelect1">
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
    </select>
</div>
<div class="form-group">
    <label for="exampleFormControlSelect2">Example multiple select</label>
    <select multiple class="form-control" id="exampleFormControlSelect2">
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
    </select>
</div>
<div class="form-group">
    <label for="exampleFormControlTextarea1">Example textarea</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
</div>


AGGIUNGI CAMPO DINAMICAMENTE https://www.webslesson.info/2016/02/dynamically-add-remove-input-fields-in-php-with-jquery-ajax.html

<html>  
      <head>  
           <title>Dynamically Add or Remove input fields in PHP with JQuery</title>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
      </head>  
      <body>  
           <!-- Aggiunta dinamica degli additivi -->
                <div class="container">   
                    <div class="form-group"> 
                        <label for="exampleFormControlInput1">Additivi</label>
                        <form name="add_name" id="add_name">  
                            <div class="table-responsive">  
                                <table class="table" id="dynamic_field">  
                                    <tr>  
                                        <td><input type="text" name="name[]" placeholder="Additivo" class="form-control name_list" /></td>  
                                        <td><button type="button" name="add" id="add" class="btn btn-success">Aggiungi</button></td>  
                                    </tr>  
                                </table>   
                            </div>  
                        </form>  
                    </div>  
                </div>     
                <script>  
                $(document).ready(function(){  
                    var i=1;  
                    $('#add').click(function(){  
                        i++;  
                        $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="name[]" placeholder="Additivo" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
                    });  
                    $(document).on('click', '.btn_remove', function(){  
                        var button_id = $(this).attr("id");   
                        $('#row'+button_id+'').remove();  
                    });  
                    $('#submit').click(function(){            
                        $.ajax({  
                                url:"name.php",  
                                method:"POST",  
                                data:$('#add_name').serialize(),  
                                success:function(data)  
                                {  
                                    alert(data);  
                                    $('#add_name')[0].reset();  
                                }  
                        });  
                    });  
                });  
                </script>