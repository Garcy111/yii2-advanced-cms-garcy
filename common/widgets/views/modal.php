<?php $this->registerCssFile('/widgets/modal/modal.css', ['depends' => 'app\assets\FontawesomeAsset']) ?>
<?php $this->registerJsFile('/widgets/modal/modal.js') ?>
<?php if (isset($message['arcticmodal'])): ?>
<?php $this->registerJsFile('/widgets/modal/arcticmodal.js', ['depends' => 'app\assets\ArcticmodalAsset']) ?>
<div style="display: none;">
	<div class="box-modal" id="modal-arcticmodal">
		<p>
			<?= $message['arcticmodal'] ?>
		</p>
	</div>
</div>
<?php endif ?>

<?php if (isset($message['success'])): ?>
<div class="modal-widget modal-success">
	<p>
		<?= $message['success'] ?>
	</p>
	<div class="close-widget">
		<i class="fa fa-times"></i>
	</div>
</div>
<?php endif ?>

<?php if (isset($message['error'])): ?>
<div class="modal-widget modal-error">
	<p>
		<?= $message['error'] ?>
	</p>
	<div class="close-widget">
		<i class="fa fa-times"></i>
	</div>
</div>
<?php endif ?>