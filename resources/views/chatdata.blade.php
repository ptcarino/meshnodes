@foreach($result as $row)
    <div class="header">
        <strong class="primary-font"><?php echo $row['username']; ?></strong>
    </div>
    <p>
        <?php echo $row['body']; ?>
    </p>
@endforeach