<?php
$themeUri = get_template_directory_uri();
?>

<?php get_template_part('include/c-footer'); ?>
</div>
<?php get_template_part('include/c-loading'); ?>
<script src="<?php echo $themeUri; ?>/assets/js/bundle.js"></script>
<?php wp_footer(); ?>
</body>

</html>