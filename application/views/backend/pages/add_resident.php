<!-- Main Content -->
<div id="content">
  <div class="container">
    <form method="POST">
      <div class="form-group">
        <div class="row">
          <div class="col">
            <label for="firstname">Fullname</label>
            <input type="text" id="full_name" name="full_name" class="form-control" />
            <span><?= form_error('firstname') ?></span>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="purok">Purok</label>
        <div class="input-group">
          <input type="text" id="purok" name="purok" class="form-control" />
          <div class="input-group-append">
            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
          </div>
        </div>
        <span><?= form_error('purok') ?></span>
      </div>
      <div class="form-group">
        <label for="barangay">Address</label>
        <div class="input-group">
          <input type="text" id="barangay" name="address" class="form-control" />
          <div class="input-group-append">
            <span class="input-group-text"><i class="fas fa-building"></i></span>
          </div>
        </div>
        <span><?= form_error('barangay') ?></span>
      </div>
      <div class="form-group">
        <label for="sex">Sex</label><br>
        <div class="form-check form-check-inline">
          <input type="radio" id="male" name="sex" value="male" class="form-check-input" />
          <label for="male" class="form-check-label">Male</label>
        </div>
        <div class="form-check form-check-inline">
          <input type="radio" id="female" name="sex" value="female" class="form-check-input" />
          <label for="female" class="form-check-label">Female</label>
        </div>
        <span><?= form_error('sex') ?></span>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="birthplace">Birth Place</label>
          <input type="text" id="birthplace" name="birth_place" class="form-control" />
          <span><?= form_error('birthplace') ?></span>
        </div>
        <div class="form-group col-md-6">
          <label for="birth_date">Birth Date</label>
          <input type="date" id="birth_date" name="birth_date" class="form-control" />
          <span><?= form_error('birth_date') ?></span>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="contact">Contact</label>
            <input type="text" id="contact" name="contact" class="form-control" />
            <span><?= form_error('contact') ?></span>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="nationality">Nationality</label>
            <input type="text" id="nationality" name="nationality" class="form-control" />
            <span><?= form_error('nationality') ?></span>
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="civilstatus">Civil Status</label>
          <select id="civilstatus" name="civil_status" class="form-control">
            <option value="single">Single</option>
            <option value="married">Married</option>
            <option value="divorced">Divorced</option>
            <option value="widowed">Widowed</option>
          </select>
          <span><?= form_error('civilstatus') ?></span>
        </div>
        <div class="form-group col-md-6">
          <label for="religion">Religion</label>
          <input type="text" id="religion" name="religion" class="form-control" />
          <span><?= form_error('religion') ?></span>
        </div>
      </div>
        </div>
      </div>
      <div class="form-group text-center">
        <button type="submit" class="btn btn-primary btn-lg">Submit</button>
      </div>
    </form>
  </div>
</div>