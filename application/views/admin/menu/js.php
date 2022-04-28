<script type="text/javascript">
    $('#set_menu__menulist').jstree({
        core: {
            themes: {
                name: 'proton', // 'default'
                responsive: true
            },
            data: <?= json_encode($tree_menu) ?>
        },
        plugins: ['checkbox']
    });
</script>