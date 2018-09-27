<?php

use Ka\Tournament\Modules\Common\Constants\PlayOffLabel;
use Ka\Tournament\Modules\Common\Interfaces\Team\Models\TeamInterface;
use Ka\Tournament\Modules\PlayOff\Helpers\PlayOffHelper;

/**
 * @var TeamInterface[] $teams
 */
?>

<div class="playoff-default-index">
    <!--    <h1>PlayOff</h1>-->

    <!--    <table class="table">-->
    <!--        <tr>-->
    <!--            <th width="1%"></th>-->
    <!--            <th colspan="2">Round 16</th>-->
    <!--            <th colspan="2">Quarter Final</th>-->
    <!--            <th colspan="2">Semi Final</th>-->
    <!--            <th colspan="2">Final</th>-->
    <!--            <th>Winner</th>-->
    <!--        </tr>-->
    <!--        <tr>-->
    <!--            <td>A1</td>-->
    <!--            <td>Uzbekistan</td>-->
    <!--            <td width="10px">3</td>-->
    <!--            <td colspan="7"></td>-->
    <!--        </tr>-->
    <!--        <tr>-->
    <!--            <td colspan="3"></td>-->
    <!--            <td>Uzbekistan</td>-->
    <!--            <td colspan="6"></td>-->
    <!--        </tr>-->
    <!--        <tr>-->
    <!--            <td>B2</td>-->
    <!--            <td>Russia</td>-->
    <!--            <td>1</td>-->
    <!--            <td colspan="7"></td>-->
    <!--        </tr>-->
    <!--    </table>-->
    <!--<div class="container">-->

    <style>
        .team {
            padding: 8px;
            border: 1px solid #ccc;
        }
    </style>


    <div class="row">
        <div class="col-sm-2 text-center">Round 16</div>
        <div class="col-sm-3 text-center">Quarter Final</div>
        <div class="col-sm-2 text-center">Semi Final</div>
        <div class="col-sm-2 text-center">Final</div>
        <div class="col-sm-3 text-center">Winner</div>
    </div>

    <div class="row" style="margin-top: 25px"></div>

    <!-- A1 -->
    <div class="row">
        <div class="col-sm-2 team">
            <div class="row">
                <div class="col-sm-2 text-muted">A1</div>
                <div class="col-sm-7">
                    <?php
                    $team = PlayOffHelper::find(PlayOffLabel::A1B2, $teams);
                    print $team === null ? '' : $team->getName();
                    ?>
                </div>
                <div class="col-sm-2 bg-success">3</div>
            </div>
        </div>
    </div>

    <!-- A1B2 winner -->
    <div class="row">
        <div class="col-sm-2 col-sm-offset-3 team">
            <div class="row">
                <div class="col-sm-9">Uzbekistan</div>
                <div class="col-sm-2 bg-success">4</div>
            </div>
        </div>
    </div>

    <!-- B2 -->
    <div class="row">
        <div class="col-sm-2 team">
            <div class="row">
                <div class="col-sm-2 text-muted">B2</div>
                <div class="col-sm-7 text-muted">Russia</div>
                <div class="col-sm-2 bg-danger">1</div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 25px"></div>

    <!-- Semi Final 1 -->
    <div class="row">
        <div class="col-sm-2 col-sm-offset-5 team">
            <div class="row">
                <div class="col-sm-9">Finland</div>
                <div class="col-sm-2 bg-success">4</div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 25px"></div>

    <!-- C1 -->
    <div class="row">
        <div class="col-sm-2 team">
            <div class="row">
                <div class="col-sm-2 text-muted">C1</div>
                <div class="col-sm-7">Uzbekistan</div>
                <div class="col-sm-2 bg-success">3</div>
            </div>
        </div>
    </div>

    <!-- C1D2 winner -->
    <div class="row">
        <div class="col-sm-2 col-sm-offset-3 team">
            <div class="row">
                <div class="col-sm-9 text-muted">Uzbekistan</div>
                <div class="col-sm-2 bg-danger">4</div>
            </div>
        </div>
    </div>

    <!-- D2 -->
    <div class="row">
        <div class="col-sm-2 team">
            <div class="row">
                <div class="col-sm-2 text-muted">D2</div>
                <div class="col-sm-7 text-muted">Russia</div>
                <div class="col-sm-2 bg-danger">1</div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 25px"></div>

    <!-- Final 1 -->
    <div class="row">
        <div class="col-sm-2 col-sm-offset-7 team">
            <div class="row">
                <div class="col-sm-9">Brazil</div>
                <div class="col-sm-2 bg-success">4</div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 25px"></div>

    <!-- E1 -->
    <div class="row">
        <div class="col-sm-2 team">
            <div class="row">
                <div class="col-sm-2 text-muted">E1</div>
                <div class="col-sm-7">Uzbekistan</div>
                <div class="col-sm-2 bg-success">3</div>
            </div>
        </div>
    </div>

    <!-- E1F2 winner -->
    <div class="row">
        <div class="col-sm-2 col-sm-offset-3 team">
            <div class="row">
                <div class="col-sm-9">Uzbekistan</div>
                <div class="col-sm-2 bg-success">4</div>
            </div>
        </div>
    </div>

    <!-- F2 -->
    <div class="row">
        <div class="col-sm-2 team">
            <div class="row">
                <div class="col-sm-2 text-muted">F2</div>
                <div class="col-sm-7 text-muted">Russia</div>
                <div class="col-sm-2 bg-danger">1</div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 25px"></div>

    <!-- Semi Final 2 -->
    <div class="row">
        <div class="col-sm-2 col-sm-offset-5 team">
            <div class="row">
                <div class="col-sm-9">Finland</div>
                <div class="col-sm-2 bg-success">4</div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 25px"></div>

    <!-- G1 -->
    <div class="row">
        <div class="col-sm-2 team">
            <div class="row">
                <div class="col-sm-2 text-muted">G1</div>
                <div class="col-sm-7">Uzbekistan</div>
                <div class="col-sm-2 bg-success">3</div>
            </div>
        </div>
    </div>

    <!-- G1H2 winner -->
    <div class="row">
        <div class="col-sm-2 col-sm-offset-3 team">
            <div class="row">
                <div class="col-sm-9 text-muted">Uzbekistan</div>
                <div class="col-sm-2 bg-danger">4</div>
            </div>
        </div>
    </div>

    <!-- H2 -->
    <div class="row">
        <div class="col-sm-2 team">
            <div class="row">
                <div class="col-sm-2 text-muted">H2</div>
                <div class="col-sm-7 text-muted">Russia</div>
                <div class="col-sm-2 bg-danger">1</div>
            </div>
        </div>
    </div>

    <!-- Winner -->
    <div class="row">
        <div class="col-sm-2 col-sm-offset-9 team">
            <div class="row">
                <div class="col-sm-9">Brazil</div>
                <div class="col-sm-2 bg-success">4</div>
            </div>
        </div>
    </div>


    <!-- A2 -->
    <div class="row">
        <div class="col-sm-2 team">
            <div class="row">
                <div class="col-sm-2 text-muted">A2</div>
                <div class="col-sm-7">Uzbekistan</div>
                <div class="col-sm-2 bg-success">3</div>
            </div>
        </div>
    </div>

    <!-- A2B1 winner -->
    <div class="row">
        <div class="col-sm-2 col-sm-offset-3 team">
            <div class="row">
                <div class="col-sm-9">Uzbekistan</div>
                <div class="col-sm-2 bg-success">4</div>
            </div>
        </div>
    </div>

    <!-- B1 -->
    <div class="row">
        <div class="col-sm-2 team">
            <div class="row">
                <div class="col-sm-2 text-muted">B1</div>
                <div class="col-sm-7 text-muted">Russia</div>
                <div class="col-sm-2 bg-danger">1</div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 25px"></div>

    <!-- Semi Final 3 -->
    <div class="row">
        <div class="col-sm-2 col-sm-offset-5 team">
            <div class="row">
                <div class="col-sm-9">Finland</div>
                <div class="col-sm-2 bg-success">4</div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 25px"></div>

    <!-- C2 -->
    <div class="row">
        <div class="col-sm-2 team">
            <div class="row">
                <div class="col-sm-2 text-muted">C2</div>
                <div class="col-sm-7">Uzbekistan</div>
                <div class="col-sm-2 bg-success">3</div>
            </div>
        </div>
    </div>

    <!-- C2D1 winner -->
    <div class="row">
        <div class="col-sm-2 col-sm-offset-3 team">
            <div class="row">
                <div class="col-sm-9 text-muted">Uzbekistan</div>
                <div class="col-sm-2 bg-danger">4</div>
            </div>
        </div>
    </div>

    <!-- D1 -->
    <div class="row">
        <div class="col-sm-2 team">
            <div class="row">
                <div class="col-sm-2 text-muted">D2</div>
                <div class="col-sm-7 text-muted">Russia</div>
                <div class="col-sm-2 bg-danger">1</div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 25px"></div>

    <!-- Final 2 -->
    <div class="row">
        <div class="col-sm-2 col-sm-offset-7 team">
            <div class="row">
                <div class="col-sm-9">Brazil</div>
                <div class="col-sm-2 bg-success">4</div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 25px"></div>

    <!-- E2 -->
    <div class="row">
        <div class="col-sm-2 team">
            <div class="row">
                <div class="col-sm-2 text-muted">E2</div>
                <div class="col-sm-7">Uzbekistan</div>
                <div class="col-sm-2 bg-success">3</div>
            </div>
        </div>
    </div>

    <!-- E2F1 winner -->
    <div class="row">
        <div class="col-sm-2 col-sm-offset-3 team">
            <div class="row">
                <div class="col-sm-9">Uzbekistan</div>
                <div class="col-sm-2 bg-success">4</div>
            </div>
        </div>
    </div>

    <!-- F2 -->
    <div class="row">
        <div class="col-sm-2 team">
            <div class="row">
                <div class="col-sm-2 text-muted">F2</div>
                <div class="col-sm-7 text-muted">Russia</div>
                <div class="col-sm-2 bg-danger">1</div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 25px"></div>

    <!-- Semi Final 4 -->
    <div class="row">
        <div class="col-sm-2 col-sm-offset-5 team">
            <div class="row">
                <div class="col-sm-9">Finland</div>
                <div class="col-sm-2 bg-success">4</div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 25px"></div>

    <!-- G2 -->
    <div class="row">
        <div class="col-sm-2 team">
            <div class="row">
                <div class="col-sm-2 text-muted">G2</div>
                <div class="col-sm-7">Uzbekistan</div>
                <div class="col-sm-2 bg-success">3</div>
            </div>
        </div>
    </div>

    <!-- G2H1 winner -->
    <div class="row">
        <div class="col-sm-2 col-sm-offset-3 team">
            <div class="row">
                <div class="col-sm-9 text-muted">Uzbekistan</div>
                <div class="col-sm-2 bg-danger">4</div>
            </div>
        </div>
    </div>

    <!-- H1 -->
    <div class="row">
        <div class="col-sm-2 team">
            <div class="row">
                <div class="col-sm-2 text-muted">H1</div>
                <div class="col-sm-7 text-muted">Russia</div>
                <div class="col-sm-2 bg-danger">1</div>
            </div>
        </div>
    </div>


    <!--</div>-->

</div>
