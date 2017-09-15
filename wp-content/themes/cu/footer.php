<footer class="mod-footer" role="contentinfo" id="footer_in">
    <p class="f_bq"><?php if($word_t2!=""){echo $word_t2;}else{echo 'Copyright';}  ?> &copy;<?php echo date("Y"); echo " "; bloginfo('name'); echo ' Powered by <a class="banquan" target="_blank" href="http://www.2zzt.com">WordPress</a>'; ?></p>
</footer>
<script>
POWERMODE.colorful = true; // ture 为启用礼花特效
POWERMODE.shake = false; // false 为禁用震动特效
document.body.addEventListener('input', POWERMODE);
</script>
<?php wp_footer(); ?>
</body></html>