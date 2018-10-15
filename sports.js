$(document).ready(function(){
  $('#team_name').on('keyup',function(){
    search_lost_team();
  });
  $('#team_name').on('blur',function(){
    search_lost_team();
  });
});

function search_lost_team(){
    let search_value = $('#team_name').val();
    let match_list_array = JSON.parse(match_list);
    let match_list_html = '';
    let lost_teams = [];
    let match_list_result =  match_list_array.map(function(value,index) {
      if(search_value.toLowerCase() == value['winner'].toLowerCase()){
        if($.inArray( value['loser'], lost_teams )== '-1'){
            lost_teams.push(value['loser']);
            match_list_html += '<li class="list-group-item">'+value['loser']+'</li>';
        }
      }
    });
    match_list_html = match_list_html == ''? '<li class="list-group-item">No teams found</li>' : match_list_html;
    $('#team_list_ul').html(match_list_html);
} 