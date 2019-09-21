<?php
/**
 * Created by Tiefanovic.
 * @author Tiefanovic
 * Email: tiefanovic.business@gmail.com
 * Phone: (+20) 122 019 0749
 * File: index.php
 * Date: 18/09/2019
 * Time: 10:52 ص
 * @copyright Tiefanovic © 2019
 */
?>
<main role="main" class="inner cover">
    <h1 class="cover-heading">Words Analyzer</h1>
    <p class="lead">Type your sentence up to 250 characters, and we analyze it for you</p>
    <?php if(!empty($result)): ?>
    <div class="row">
            <div class="col-md-12">
                <div class="card text-white bg-dark">
                    <div class="card-header">Analyze Report</div>
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">Char</th>
                                <th scope="col">Count</th>
                                <th scope="col">before Chars</th>
                                <th scope="col">after Chars</th>
                                <th scope="col">Max distance</th>
                            </tr>
                            </thead>
                            <tbody>

                                <?php foreach($result as $report):?>
                                <?php /** @var \App\Model\Report $report */ ?>
                                    <tr scope="row">
                                        <td><?php echo $report->getChar(); ?></td>
                                        <td><?php echo $report->getCount(); ?></td>
                                        <td><?php echo $report->getBefore() ?: 'null'; ?></td>
                                        <td><?php echo $report->getAfter() ?: 'null'; ?></td>
                                        <td><?php echo $report->getMaxDistance(); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot class="thead-dark">
                            <tr>
                                <th scope="col">Char</th>
                                <th scope="col">Count</th>
                                <th scope="col">before Chars</th>
                                <th scope="col">after Chars</th>
                                <th scope="col">Max distance</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-12">
                <form method="post" action="/words/analyze">
                <input type="hidden" name="_token" value="<?php echo $this->getFormKey();?>">
                <div class="form-group">
                    <textarea class="form-control" name="sentence" rows="7" maxlength="250" placeholder="Please type your sentence here..."></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-lg btn-primary">Analyze it.</button>
                </div>
            </form>
        </div>
    </div>
</main>

