<?php
// I hate PHP

date_default_timezone_set('Asia/Shanghai');
$genTime = date("Y-m-d H:i:s");
header('Content-type: text/plain');  

$load = "Error";
$curNodes = "080808080";
$curBandwidth = "0808080";
$todayData = "08080808";
$todayHit = "080808080";

$sponsorUrl = "https://bd.bangbang93.com";

$remote = json_decode(file_get_contents("https://bd.bangbang93.com/openbmclapi/metric/dashboard"));
$load = round($remote->{"load"}*100,2);
$curNodes = $remote->{"currentNodes"};
$curBandwidth = round($remote->{"currentBandwidth"},2);
$todayData = round($remote->{"bytes"}/1099511627776,2);
$todayHit = $remote->{"hits"};

$remote = json_decode(file_get_contents("https://bmclapi2.bangbang93.com/openbmclapi/sponsor"));
$sponsorUrl = $remote->{"link"};

header('Cache-control:public, max-age=180');
?>

<Grid>
        <Grid.ColumnDefinitions>
            <ColumnDefinition Width="0.8*"/>
            <ColumnDefinition />
        </Grid.ColumnDefinitions>
        <Grid.RowDefinitions>
            <RowDefinition />
            <RowDefinition />
            <RowDefinition />
            <RowDefinition />
            <RowDefinition Height="35" />
        </Grid.RowDefinitions>
            <local:MyCard Title="OpenBMCLAPI 仪表盘 Lite" Margin="0,0,0,5" Grid.Row="0" Grid.Column="0" Grid.ColumnSpan="2" Tooltip="当前仪表盘缓存的获取时间">
                    <TextBlock Margin="25,12,20,10" HorizontalAlignment="Right">
                        <?php print $genTime?> (UTC+8)
                    </TextBlock>
            </local:MyCard>

            <local:MyCard Title="在线节点" Margin="0,0,2,4" Grid.Row="1" Grid.Column="0">
                <StackPanel Margin="25,40,23,15">
                    <TextBlock Margin="0,0,0,4" HorizontalAlignment="Center" TextWrapping="Wrap">
                        <Run Text="<?php print $curNodes;?>" FontSize="26"/> 个
                    </TextBlock>
                </StackPanel>
            </local:MyCard>

            <local:MyCard Title="出网带宽" Margin="2,0,0,4" Grid.Row="1" Grid.Column="1">
                <StackPanel Margin="25,40,23,15">
                    <TextBlock Margin="0,0,0,4" HorizontalAlignment="Center" TextWrapping="Wrap">
                        <Run Text="<?php print $curBandwidth;?>" FontSize="26"/> Mbps
                    </TextBlock>
                </StackPanel>
            </local:MyCard>

            <local:MyCard Title="今日流量" Margin="0,0,2,4" Grid.Row="2" Grid.Column="0">
                <StackPanel Margin="25,40,23,15">
                <TextBlock Margin="0,0,0,4" HorizontalAlignment="Center" TextWrapping="Wrap">
                        <Run Text="<?php print $todayData;?>" FontSize="26"/> TiB
                    </TextBlock>
                </StackPanel>
            </local:MyCard>

            <local:MyCard Title="今日请求数" Margin="2,0,0,4" Grid.Row="2" Grid.Column="1">
                <StackPanel Margin="25,40,23,15">
                    <TextBlock Margin="0,0,0,4" HorizontalAlignment="Center" TextWrapping="Wrap">
                        <Run Text="<?php print $todayHit;?>" FontSize="26"/> 次
                    </TextBlock>
                </StackPanel>
            </local:MyCard>

            <local:MyCard Title="主控负载" Margin="0,0,0,4" Grid.Row="3" Grid.Column="0" Grid.ColumnSpan="2">
                <StackPanel Margin="25,40,23,15">
                    <TextBlock Margin="0,0,0,4" HorizontalAlignment="Center" TextWrapping="Wrap">
                        <Run Text="<?php print $load;?>" FontSize="26"/> %
                    </TextBlock>
                    <TextBlock Margin="0,0,0,4" HorizontalAlignment="Center" TextWrapping="Wrap">
                        （此处数据超过 100% 是正常现象）
                    </TextBlock>
                </StackPanel>
            </local:MyCard>

            <local:MyButton Margin="2,0,0,0" Grid.Row="4" Grid.Column="1" ColorType="Highlight" Text="查看赞助商信息" EventType="打开网页" EventData="<?php print $sponsorUrl?>" ToolTip="查看来自 OpenBMCLAPI 赞助商的广告" />
            <local:MyButton Margin="0,0,2,0" Grid.Row="4" Grid.Column="0" Text="刷新" EventType="刷新主页" ToolTip="重新加载数据，请勿频繁点击" />
            
    </Grid>
