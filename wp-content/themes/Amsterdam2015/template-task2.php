<?php
/*
Template Name: Knowledge Sharing
*/
get_header();

require 'class.amsterdamAPI.php';

$apiKey = 'lC7UO1LW75kSeyhaHfFB9IMnTuZPn9fdBtDTSTbcX76k1oLXdMp3ZvVFYdv5';
$apiSecret = '1svooKg0SCigJ2pPG3RnfIWpJwlqzesiaEmV76iCnbAZwOBONOqg9JVnKQNM';
$amsterdam = new AmsterdamAPI($apiKey, $apiSecret);


?>

<main role="main">
  <div class="container">
      <?php if (!isset($_GET['c'])) : $committees = $amsterdam->committees(); ?>
          <section class="albums">
              <?php foreach($committees as $committee) : ?>
              <div class="single-album col-xs-12 col-sm-6 col-md-4 col-lg-4">
                  <div>
                      <h2 class="text-center album-title"><a href="?c=<?php echo $committee->id; ?>"><?php echo $committee->name; ?></a></h2>
                  </div>
              </div>
              <?php endforeach; ?>
          </section>
          <?php else : $representations = json_decode($amsterdam->taskThreeByCommittee($_GET['c'])); ?>
          <section class="single-album">
              <div class="modal fade" id="addNewLink">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title">Add a new link</h4>
                          </div>
                          <div class="modal-body">
                              {!! Form::open(array('route' => ['knowledge.committee.create', 'committee' => $committee])) !!}
                              <fieldset>
                                  {!! Form::hidden('committee', $committee) !!}
                                  {!! Form::label('title','Title') !!}
                                  {!! Form::text('title', null, array('class' => 'form-control')) !!}
                                  {!! Form::label('url','What is the address to the resource?') !!}
                                  {!! Form::text('url', null, array('class' => 'form-control')) !!}
                                  {!! Form::label('description', 'Give a short description of the resource') !!}
                                  {!! Form::textarea('description') !!}
                              </fieldset>
                              {!! Form::submit('Submit', array('class' => 'btn btn-primary')) !!}
                              {!! Form::close() !!}
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary">Save changes</button>
                          </div>
                      </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->
          <?php if (sizeof($representations) > 0) : ?>
                <?php foreach ($representations as $representation) : ?>
                    <?php
                    $src = 'http://task1.apps.tandem15.eu/uploads/' . $representation->representation;
                    ?>
                    <li class="col-xs-6 col-md-3" data-sub-html="<p><em>By <?php echo $representation->first_name . ' ' . $representation->last_name; ?></em></p>" data-src="<?php echo $src; ?>"><img class="col-xs-12" src="<?php echo $src; ?>" alt=""/></li>
                <?php endforeach; ?>
              <?php else : ?>
              <p>Unfortunately, there seems to be nothing here!</p>
          <?php endif; ?>
              <h2><a href="http://task1.apps.tandem15.eu">Add a representation</a></h2>
          </section>
      <?php endif; ?>
  </div>
</main>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#lightGallery").lightGallery();
        });
    </script>

<?php get_footer(); ?>