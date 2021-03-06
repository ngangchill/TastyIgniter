<?php echo get_header(); ?>
<div class="row content">
	<div class="col-md-12">
		<div class="panel panel-default panel-table">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo lang('text_list'); ?></h3>
			</div>
			<form role="form" id="list-form" accept-charset="utf-8" method="POST" action="<?php echo current_url(); ?>">
				<div class="table-responsive">
					<table border="0" class="table table-striped table-border">
						<thead>
							<tr>
								<th></th>
								<th><?php echo lang('column_name'); ?></th>
								<th class="text-center"></th>
							</tr>
						</thead>
						<tbody>
							<?php if ($themes) { ?>
							<?php foreach ($themes as $theme) { ?>
							<tr>
								<td><img class="img-responsive img-thumbnail" alt="" src="<?php echo $theme['screenshot']; ?>" style="width:200px!important;height:200px!important" /></td>
								<td><?php echo $theme['title']; ?> <b class="small">(<?php if ($theme['active'] === '1') echo lang('text_is_default'); ?>)</b><br />
									<i><?php echo $theme['description']; ?></i><br />
                                    <span class="text-mute text-sm"><b><?php echo lang('text_location'); ?>:</b> <?php echo $theme['location']; ?></span>
								</td>
								<td class="text-center">
									<?php if ($theme['active'] === '1') { ?>
										<a class="btn btn-edit" title="<?php echo lang('text_customize'); ?>" href="<?php echo $theme['edit']; ?>"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
										<a class="btn btn-warning" disabled="disabled" title="<?php echo lang('text_is_default'); ?>"><i class="fa fa-star"></i></a>&nbsp;&nbsp;
										<a class="btn btn-info preview-thumb" title="<?php echo lang('text_preview'); ?>" href="<?php echo $theme['screenshot']; ?>" title="Default"><i class="fa fa-eye"></i></a>
									<?php } else {?>
										<a class="btn btn-edit" title="<?php echo lang('text_customize'); ?>" href="<?php echo $theme['edit']; ?>"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
										<a class="btn btn-warning" title="<?php echo lang('text_set_default'); ?>" href="<?php echo $theme['activate']; ?>"><i class="fa fa-star"></i></a>&nbsp;&nbsp;
										<a class="btn btn-info preview-thumb" title="<?php echo lang('text_preview'); ?>" href="<?php echo $theme['screenshot']; ?>" title="Default"><i class="fa fa-eye"></i></a>
									<?php } ?>
								</td>
							</tr>
							<?php } ?>
							<?php } else {?>
							<tr>
								<td colspan="3"><?php echo lang('text_empty'); ?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</form>
		</div>
	</div>
</div>
<link type="text/css" rel="stylesheet" href="<?php echo root_url("assets/js/fancybox/jquery.fancybox.css"); ?>">
<script src="<?php echo root_url("assets/js/fancybox/jquery.fancybox.js"); ?>"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.preview-thumb').fancybox();
});
</script>
<?php echo get_footer(); ?>