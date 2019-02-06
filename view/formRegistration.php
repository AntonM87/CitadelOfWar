<!--<div class="container-fluid main-content-block p-5">-->
<div class="form-registration">
            <form>
                <div class="form-control">
                    <div>
                        <label>Email:</label>
                        <small>Только латинские буквы и цифры</small>
                    </div>
                    <div class="input-container input-container-required">
                        <input autocomplete="on" id='reg-form-email' type="email" class="form-control" value="">
                    </div>
                </div>
                <div class="form-control">
                    <div>
                        <label>Никнейм (псевдоним): </label>
                        <small>Буквы/цифры, тире, подчёркивание.Не мене 3х символов.</small>
                    </div>
                    <div class="input-container input-container-required">
                        <input role="nick" id='reg-form-nick' class="form-control" value="">
                    </div>
                </div>
                <div class="form-control">
                    <div>
                        <label for="exampleInputEmail1">Пароль:</label>
                        <small>Пароль должен содержать прописные,заглавные символы и цифры.Не менее 8ми символов.</small>
                    </div>
                    <div class="input-container input-container-required">
                        <input data-valid="false" role="firstPass" id='reg-form-pass' type="password" class="form-control">
                    </div>
                </div>
                <div class="form-control">
                    <div>
                        <label for="exampleInputEmail1">Повторите пароль:</label>
                    </div>
                    <div class="input-container input-container-required">
                        <input data-valid="false" role="secondPass" id='reg-form-pass-second' type="password" class="form-control">
                    </div>
                </div>
                <div class="form-control">
                    <div>
                        <label for="exampleInputEmail1">Ваш пол:</label>
                    </div>
                    <div class="input-container">
                        <select name="sex">
                            <option value="male">Мужской</option>
                            <option value="female">Женский</option>
                        </select>
                    </div>
                </div>
                <div class="form-control date-birth-reg">
                    <div>
                        <label for="exampleInputEmail1">Дата рождения:</label>
                    </div>
                    <div class="input-container">
                        <select type="text" class="mr-2" name="dateBirthDay">
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                            <option value="07">07</option>
                            <option value="08">08</option>
                            <option value="09">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                        </select>
                        <select type="text" class="mr-2" name="dateBirthMonth">
                            <option value="1">Январь</option>
                            <option value="2">Февраль</option>
                            <option value="3">Март</option>
                            <option value="4">Апрель</option>
                            <option value="5">Май</option>
                            <option value="6">Июнь</option>
                            <option value="7">Июль</option>
                            <option value="8">Август</option>
                            <option value="9">Сентябрь</option>
                            <option value="10">Октябрь</option>
                            <option value="11">Ноябрь</option>
                            <option value="12">Декабрь</option>
                        </select>
                        <select type="text" name="dateBirthYear">
                            <option value="1970">1970</option>
                            <option value="1971">1971</option>
                            <option value="1972">1972</option>
                            <option value="1973">1973</option>
                            <option value="1974">1974</option>
                            <option value="1975">1975</option>
                            <option value="1976">1976</option>
                            <option value="1977">1977</option>
                            <option value="1978">1978</option>
                            <option value="1979">1979</option>
                            <option value="1980">1980</option>
                            <option value="1981">1981</option>
                            <option value="1982">1982</option>
                            <option value="1983">1983</option>
                            <option value="1984">1984</option>
                            <option value="1985">1985</option>
                            <option value="1986">1986</option>
                            <option value="1987">1987</option>
                            <option value="1988">1988</option>
                            <option value="1989">1989</option>
                            <option value="1990">1990</option>
                            <option value="1991">1991</option>
                            <option value="1992">1992</option>
                            <option value="1993">1993</option>
                            <option value="1994">1994</option>
                            <option value="1995">1995</option>
                            <option value="1996">1996</option>
                            <option value="1997">1997</option>
                            <option value="1998">1998</option>
                            <option value="1999">1999</option>
                            <option value="2000">2000</option>
                            <option value="2001">2001</option>
                            <option value="2002">2002</option>
                            <option value="2003">2003</option>
                            <option value="2004">2004</option>
                            <option value="2005">2005</option>
                            <option value="2006">2006</option>
                            <option value="2007">2007</option>
                            <option value="2008">2008</option>
                            <option value="2008">2008</option>
                            <option value="2010">2010</option>
                        </select>
                    </div>
                </div>
                <div class="form-control spam-protection">
                    <div>
                        <label for="exampleInputEmail1">Защита от спама:</label>
                        <small>Введите информацию с картинки:</small>
                    </div>
                    <div class="input-container input-container-required">
                        <!-- вставка капчи -->
<!--                        <div class="captcha" --><?php //'../model/captcha_img.php'?><!--</div>-->
                        <div class="captcha">
                            <?php echo '<img src="../model/captcha_img.php">'?>
                        </div>
                        <a class="pr-2 pl-2" id="captchaRestart" href="#">Обновить<br>картинку</a>
                        <input id="captchaInput" role="captcha" type="capcha" class="form-control">
                    </div>
                </div>
                <div class="w-100">
                    <button id='btnReg' disabled type="submit" class="not-active btn btn-primary">Зарегестрироваться</button>
                </div>
            </form>
        </div>
<!--</div>-->

