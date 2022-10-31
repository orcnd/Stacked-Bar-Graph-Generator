<?php $this->view('header'); ?> 


<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Stacked Bar Graph Generator</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <button class="nav-link" data-bs-toggle="modal" data-bs-target="#addCSVModal">Add Data</button>
        </li>
        <li class="nav-item">
            <div class="input-group">       
                <div class="input-group-text">min:</div>
                <input class="form-control form-control-sm" id="min" placeholder="min" type="number" value="0">
            </div>
        </li>
        <li class="nav-item">
            <div class="input-group">       
                <div class="input-group-text">max:</div>
                <input class="form-control form-control-sm" id="max" placeholder="max" type="number" value="100">
            </div>
        </li>
        <li class="nav-item">
            <label>Bar Inside text color</label>    
                <input type="color" id="barInsideColor">
            </label>
        </li>
        <li>
            <button id="regenerateButton" class="btn btn-primary">Regenerate</button>
        </li>
        
      </ul>
    </div>
  </div>
</nav>

<div id="canvasContainer">
    <canvas id="myChart" width="400" height="400"></canvas>
</div>

<div class="modal" id="addCSVModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <textarea class="form-control" id="csvData" rows="3"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="addDataSave">Save</button>
      </div>
    </div>
  </div>
</div>
<?php $this->view('footer');
