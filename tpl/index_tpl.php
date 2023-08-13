<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Todo List</title>
  <!-- MDB icon -->
  <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
  <!-- font style css -->
  <link rel="stylesheet" href="assets/css/font-style.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
  <!-- MDB -->
  <link rel="stylesheet" href="assets/css/bootstrap-to-do-list.min.css" />
  <link rel="stylesheet" href="assets/css/graid.css">
  <link rel="stylesheet" href="assets/css/index.css">

</head>

<body>
    <?php if (!empty($_SESSION['error'])) : ?>
			<h3 class="session-alert"><?= $_SESSION['error'] ?></h3>
		<?php unset($_SESSION['error']);endif; ?>
  <!-- Start your project here-->
  <section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col">
          <div class="card" id="list1" style="border-radius: .75rem; background-color: #eff1f2;">
            <div class="card-body py-4 px-4 px-md-5">

              <p class="h1 text-center mt-3 mb-4 pb-3 ">
                TODO LIST PAGE
              </p>
              <!-- satrt add folder -->
              <div class="pb-2">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-row align-items-center">
                      <input type="text" class="form-control form-control-lg" id="addNewFolderInput" placeholder="Add new folder...">
                      <div>
                        <button type="button" class="btn btn-primary" id="addBtnNewFolder">Add</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end add folder -->
              <!-- start folders -->
              <section class="container" >
                  <div class="row ">
                    <div class="col-xs-2 col-s-2 col-md-2 col-l-2 col-xl-2 active" >
                      <a href="?folder_id=0">
                        <i class="fa fa-folder folders"></i>
                        <p class="name-folder ">Home folder</p>
                        
                      </a>
                    </div>
                  </div>
                <?php foreach($folder_data as $key => $valuse): ?>
                  <div class="row ">
                    <div class="col-xs-2 col-s-2 col-md-2 col-l-2 col-xl-2" >
                      <a href="?folder_id=<?= $valuse['id']; ?>">
                        <i class="fa fa-folder folders"></i>
                        <p class="name-folder"><?= $valuse['name']; ?></p>
                        <a href="?delete_folder=<?= $valuse['id']; ?>"><i class="fas fa-trash-alt delete_folder"></i></a>
                      </a>
                    </div>
                  </div>
                  <?php endforeach ; ?>
              </section>
              <!-- end folders -->
              <hr class="my-4">      
              <!-- start add task -->
              <div class="d-flex justify-content-end align-items-center mb-4 pt-2 pb-3" style="margin: 0 auto;"> 
                <div class="pb-2">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex flex-row align-items-center">
                        <input type="text" class="form-control form-control-lg" id="exampleFormControlInput1" placeholder="Add new Task...">
                        <a href="#!" data-mdb-toggle="tooltip" title="Set due date"></a>
                        <div>
                          <button type="button" class="btn btn-primary">Add</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>   
              <!-- end add task -->
              <?php foreach ($task_data as $key => $value) : ?>
                <ul class="list-group list-group-horizontal rounded-0 bg-transparent">
                  <li class="list-group-item d-flex align-items-center ps-0 pe-3 py-1 rounded-0 border-0 bg-transparent">
                    <div class="form-check">
                      <input
                        class="form-check-input me-0"
                        type="checkbox"
                        value=""
                        id="flexCheckChecked1"
                        aria-label="..."
                        checked
                      />
                    </div>
                  </li>
                  <li class="list-group-item px-3 py-1 d-flex align-items-center flex-grow-1 border-0 bg-transparent">
                    <p class="lead fw-normal mb-0"><?= $value['title'] ;?></p>
                  </li>
                  <li class="list-group-item ps-3 pe-0 py-1 rounded-0 border-0 bg-transparent">
                    <div class="d-flex flex-row justify-content-end mb-1">
                      <a href="#!" class="text-info" data-mdb-toggle="tooltip" title="Edit todo"><i class="fas fa-pencil-alt me-3"></i></a>
                      <a href="#!" class="text-danger" data-mdb-toggle="tooltip" title="Delete todo"><i class="fas fa-trash-alt"></i></a>
                    </div>
                    <div class="text-end text-muted">
                      <a href="#!" class="text-muted" data-mdb-toggle="tooltip" title="Created date">
                        <p class="small mb-0"><i class="fas fa-info-circle me-2"></i>28th Jun 2020</p></a>
                    </div>
                  </li>
                </ul>
              <?php endforeach ; ?>
       

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End your project here-->

  <!-- MDB -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Custom scripts -->
  <script type="text/javascript"></script>
  <!-- jquery cdn -->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

  <script>
    $(document).ready(function(){
      $('#addBtnNewFolder').click(function(e){
        var input = $('input#addNewFolderInput') ;
        $.ajax({
          url : 'process/ajax_handler.php',
          method : 'post',
          data : {action:'addFolder',folderName:input.val()},
          success : function(response){
            if (response=='1') {
            
              $('<div class="row "> <div class="col-xs-2 col-s-2 col-md-2 col-l-2 col-xl-2" > <a href="?folder_id=<?= $valuse['id']; ?>"> <i class="fa fa-folder folders"></i> <p class="name-folder">' +input.val()+ '</p> <a href="?delete_folder=<?= $valuse['id']; ?>"></a> </a> </div> </div>').appendTo('.container')
            }else{
              alert(response) ;
            }
          }
        });
      }) ;
    }) ;
  </script>
</body>

</html>