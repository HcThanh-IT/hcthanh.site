<div class="container_music">
  <div class="radio-wrapper">
    <input type="radio" id="value-1" name="btn" class="input" />
    <div class="btn">
      <span aria-hidden="">_</span>Music
      <span aria-hidden="" class="btn__glitch">_Music🦾</span>
      <label class="number">r1</label>
    </div>
    <audio id="audio-1" src="./ADMIN/uploads/OK_Lak.mp3" preload="auto"></audio>
  </div>
  
  <div class="radio-wrapper">
    <input type="radio" id="value-2" name="btn" class="input" />
    <div class="btn">
      _Zalo<span aria-hidden="">_</span>
      <span aria-hidden="" class="btn__glitch">_Z_a_l_o_</span>
      <label class="number">r2</label>
    </div>
    <audio id="audio-2" src="./ADMIN/uploads/OK_Lak.mp3" preload="auto"></audio>
  </div>
  
  <div class="radio-wrapper">
    <input type="radio" id="value-3" name="btn" class="input" />
    <div class="btn">
      Tiktok<span aria-hidden=""></span>
      <span aria-hidden="" class="btn__glitch">Tiktok_</span>
      <label class="number">r3</label>
    </div>
    <audio id="audio-3" src="./ADMIN/uploads/OK_Lak.mp3" preload="auto"></audio>
  </div>
</div>

<script>
  // Lấy tất cả các thẻ audio
  const audios = [
    document.getElementById('audio-1'),
    document.getElementById('audio-2'),
    document.getElementById('audio-3')
  ];

  // Thêm sự kiện click vào toàn bộ trang
  document.addEventListener('click', () => {
    // Dừng tất cả các âm thanh trước
    audios.forEach(audio => {
      audio.pause();
      audio.currentTime = 0;
    });

    // Kiểm tra từng radio button
    if (document.getElementById('value-1').checked) {
      audios[0].play();
    } else if (document.getElementById('value-2').checked) {
      audios[1].play();
      window.open('https://zalo.me/0966755577', '_blank'); // Mở liên kết Zalo
    } else if (document.getElementById('value-3').checked) {
      audios[2].play();
      window.open('https://www.tiktok.com/@hcthanh.site', '_blank'); // Mở liên kết TikTok
    }
  });
</script>
