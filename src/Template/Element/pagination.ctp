<div class="pagina text-center col-lg-12">	

	<ul class="pagination">
	    <?php echo $this->Paginator->first('<< ' . __('Primero')) ?>
	    <?php echo $this->Paginator->prev('< ' . __('Anterior')) ?>
	    <?php echo $this->Paginator->numbers() ?>
	    <?php echo $this->Paginator->next(__('Proximo') . ' >') ?>
	    <?php echo $this->Paginator->last(__('Ultimo') . ' >>') ?>
	</ul>
	<p><?php echo $this->Paginator->counter(['format' => __('Pagina {{page}} de {{pages}}, mostrando {{current}} registro(s) de {{count}} total')]) ?></p>

</div>

