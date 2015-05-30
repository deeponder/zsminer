<div class="url-position">我的位置>招生宣传>各省中学分布情况及基本情况</div>
<div id="table-cont">
    <div class="school-inf">
        <h3>学校基本信息</h3>
        <section>
            <div class="left-inf">
                <p>省份：<?php echo $pro['0']['name']; ?></p>
                <p>中学性质：<?php echo $property; ?></p>
                <p>邮编：<?php echo $middle['0']['zipCode']; ?></p>
            </div>
            <div class="right-inf">
                <p>地市：<?php echo $ci['0']['name']; ?></p>
                <p>ID：<?php echo $middle['0']['code']; ?></p>
                <p>地址：<?php echo $middle['0']['address']; ?></p>
            </div>
        </section>
    </div>
    <div class="school-inf" id="contact-way">
        <h3>联系方式 <span><a href="editSchool?code=<?php echo $middle['0']['code']; ?>&position=<?php echo $wor['0']['position']; ?>&tel=<?php echo $wor['0']['tel']; ?>">修改</a></span></h3>
        <section>
            <div class="left-inf">
                <p><?php echo $wor['0']['position']; ?>:<?php echo $wor['0']['tel']; ?></p>
            </div>
        </section>

    </div>
</div>