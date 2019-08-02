package com.itzijin.controller;

import com.itzijin.domain.Article;
import com.itzijin.service.ArticleService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import java.util.List;

/**
 * @Author: 陈尚宇
 * @Date: 2019/8/2 17:23
 * Function:
 */
@RestController
@RequestMapping("/list")
public class ArticleController {

    @Autowired
    private ArticleService articleService;

    @RequestMapping("/findAll")
    public List<Article> findAll(){
        return articleService.findAll();
    }

    @RequestMapping("/findById/{id}")
    public Article findById(@PathVariable String id) {
        return articleService.findById(id);
    }

}
