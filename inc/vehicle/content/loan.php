<?php if (isset($_POST['submit'])) { ?>
    <div id="loan-details">
        <h2><?php echo esc_html__('Vehicle Loan Repayments By Month', 'drivco') ?></h2>
        <?php

        $balance = (float) $_POST['vehicle_value'];

        $monthly_payment = (($_POST['interest_rate'] / (100 * 12)) * $_POST['vehicle_value']) / (1 - pow(1 + $_POST['interest_rate'] / 1200, (-$_POST['months'])));
        ?>
        <p>
            <?php echo esc_html__('Loan Payments:', 'drivco') ?> <?php echo $_POST['currency'] . number_format($monthly_payment * $_POST['months'], 2); ?><br />
            <?php echo esc_html__('Monthly Payment:', 'drivco') ?> <?php echo $_POST['currency'] . number_format($monthly_payment, 2); ?><br />
            <?php echo esc_html__('Total Interest:', 'drivco') ?> <?php echo $_POST['currency'] . number_format($monthly_payment * $_POST['months'] - $balance, 2); ?>
        </p>
        <table>
            <tbody>
                <tr>
                    <th><?php echo esc_html__('Month', 'drivco') ?></th>
                    <th><?php echo esc_html__('Balance', 'drivco') ?></th>
                    <th><?php echo esc_html__('Principal', 'drivco') ?></th>
                    <th><?php echo esc_html__('Interest', 'drivco') ?></th>
                    <th><?php echo esc_html__('Payment', 'drivco') ?></th>
                </tr>
                <?php
                for ($month = 0; $month < (int)$_POST['months']; $month++) {
                    $interest = $balance * $_POST['interest_rate'] / 1200;
                    $principal = $monthly_payment - $interest;
                ?>
                    <tr>
                        <td><?php echo $month + 1 ?></td>
                        <td><?php echo $_POST['currency'] . number_format($balance, 2) ?></td>
                        <td><?php echo $_POST['currency'] . number_format($principal, 2) ?></td>
                        <td><?php echo $_POST['currency'] . number_format($interest, 2) ?></td>
                        <td><?php echo $_POST['currency'] . number_format($monthly_payment, 2) ?></td>
                    </tr>
                <?php
                    $balance -= $principal;
                }
                ?>
            </tbody>
        </table>
    </div>
<?php } ?>