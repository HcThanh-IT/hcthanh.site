<div class="container_music">
  <div class="radio-wrapper">
    <input type="radio" id="value-1" name="btn" class="input" />
    <div class="btn">
      <span aria-hidden="">_</span>Music1
      <span aria-hidden="" class="btn__glitch">_Music🦾</span>
      <label class="number">r1</label>
    </div>
    <!-- Thêm audio cho button đầu tiên -->
    <audio id="audio-1" src="./ADMIN/uploads/OK_Lak.mp3" preload="auto"></audio>
  </div>
  <div class="radio-wrapper">
    <input type="radio" checked="true" id="value-2" name="btn" class="input" />
    <div class="btn">
      
      _Zalo<span aria-hidden="">_</span>
      <span aria-hidden="" class="btn__glitch">_Z_a_l_o_</span>
      <label class="number">r2</label>
    </div>
    <!-- Thêm audio cho button thứ hai -->
    <audio id="audio-2" src="your-music-file-2.mp3" preload="auto"></audio>
  </div>
  
  
  <div class="radio-wrapper">
    <input type="radio" id="value-3" name="btn" class="input" />
    <div class="btn">
      Tiktok<span aria-hidden=""></span>
      <span aria-hidden="" class="btn__glitch">Tiktok_</span>
      <label class="number">r3</label>
    </div>
    <!-- Thêm audio cho button thứ ba -->
    <audio id="audio-3" src="your-music-file-3.mp3" preload="auto"></audio>
  </div>
</div>
<script>
  // Lấy các radio buttons và các thẻ audio tương ứng
const radioButtons = document.querySelectorAll('.input');
const audios = [
  document.getElementById('audio-1'),
  document.getElementById('audio-2'),
  document.getElementById('audio-3')
];

// Lắng nghe sự kiện thay đổi trạng thái của các radio button
radioButtons.forEach((radio, index) => {
  radio.addEventListener('change', () => {
    // Dừng tất cả các audio
    audios.forEach(audio => audio.pause());
    audios.forEach(audio => audio.currentTime = 0); // Đặt lại vị trí phát nhạc về đầu
    
    // Phát audio tương ứng với button được chọn
    if (radio.checked) {
      audios[index].play();
    }
  });
});

</script>