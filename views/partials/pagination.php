<?php
if ( $total_pages <= 1 ){
	return;
}
?>
<div class="card-footer py-4">
	<nav aria-label="...">
		<ul class="pagination justify-content-end mb-0">
			<li class="page-item <?php echo $page > 1 ? '' : 'disabled'; ?>">
				<a class="page-link" href="<?php echo $page > 1 ? sprintf('%s/page/%d', untrailingslashit( $pagination_url ), $page - 1) : trailingslashit( $pagination_url ); ?>">
					<i class="fas fa-angle-left"></i>
					<span class="sr-only">Previous</span>
				</a>
			</li>
			<?php for ($i=1; $i < $total_pages+1; $i++) {
				$active = $page == $i;
				$page_url = $i <= 1  ? trailingslashit( $pagination_url ) : sprintf('%s/page/%d', untrailingslashit( $pagination_url ), $i);
				?>
				<li class="page-item <?php echo $active ? 'active' : '' ?>">
					<a class="page-link" href="<?php echo $active ? '#' : $page_url; ?>"><?php echo $i; ?></a>
				</li>
				<?php
			} ?>
			<li class="page-item <?php echo $page >= $total_pages ? 'disabled' : ''; ?>">
				<a class="page-link" href="<?php echo $page >= $total_pages ? '#' : sprintf('%s/page/%d', untrailingslashit( $pagination_url ), $page + 1) ?>">
					<i class="fas fa-angle-right"></i>
					<span class="sr-only">Next</span>
				</a>
			</li>
		</ul>
	</nav>
</div>